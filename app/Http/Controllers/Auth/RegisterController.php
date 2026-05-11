<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public function show(): View
    {
        return view('pages.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'agree_terms' => ['accepted', 'required'],
        ]);

        try {
            $result = $this->service->registerUser($validated);
            dd($request);
            Auth::login($result['user']);

            return redirect()->intended('/profile')
                ->with('успешно', 'Вы успешно зарегистрированы!');

        } catch (\Exception $e) {
            \Log::error('Сетевая ошибка: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Не удалось завершить регистрацию. Попробуйте позже.'])
                ->withInput();
        }
    }
}
