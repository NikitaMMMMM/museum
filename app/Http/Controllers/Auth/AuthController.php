<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;   // ← наследуем правильный базовый контроллер
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected int $maxAttempts = 5;
    protected int $decaySeconds = 60;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $this->ensureIsNotRateLimited($request);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));
            Auth::user()->forceFill(['last_login' => now()])->save();

            return redirect()->intended(route('auth.profile'))
                ->with('success', 'Вы успешно вошли.');
        }

        RateLimiter::hit($this->throttleKey($request), $this->decaySeconds);

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pages.index')
            ->with('success', 'Вы вышли из системы.');
    }

    protected function ensureIsNotRateLimited(Request $request): void
    {
        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', ['seconds' => $seconds]),
            ]);
        }
    }

    protected function throttleKey(Request $request): string
    {
        return mb_strtolower($request->input('email')) . '|' . $request->ip();
    }
}