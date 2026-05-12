<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class RegisterController extends BaseController
{
    public function show(): View
    {
        return view('pages.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        
        $data = $request->validated();

        try {
            $avatarUrl = null;
            if ($request->hasFile('avatar_url')) {
                $file = $request->file('avatar_url');
                if ($file instanceof UploadedFile) {
                    $path = $file->storePublicly('avatars', 'public');
                    $avatarUrl = $path ? 'storage/' . $path : null;
                }
            }

            $data['avatar_url'] = $avatarUrl;
            $result = $this->service->registerUser($data);

            Auth::login($result['user']);

            return redirect()->route('auth.profile');

        } catch (\Exception $e) {
            \Log::error('Ошибка регистрации: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Не удалось завершить регистрацию. Попробуйте позже.'])
                ->withInput()
                ->with('success', 'Регистрация прошла успешно!');
        }
    }
}
