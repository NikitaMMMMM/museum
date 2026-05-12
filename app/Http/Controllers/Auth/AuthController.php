<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends BaseController
{
    public function logout(): RedirectResponse
    {
        Auth::logout(); 

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('pages.index')
            ->with('success', 'Вы успешно вышли из системы.');
    }
}
