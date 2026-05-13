<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Показывает страницу с просьбой проверить почту.
     */
    /**
     * Приходит на /email/verify.
     */
    public function notice(): RedirectResponse
    {
        return redirect()->route('auth.profile')->with('success', 'Проверьте свою почту и подтвердите email.');
    }

    /**
     * Подтверждает email по подписанной ссылке.
     */
    public function verify(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Дополнительная проверка, что ID из маршрута совпадает с текущим пользователем
        if ($user->id !== (int) $request->route('id')) {
            abort(403);
        }

        // Если email уже подтверждён
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('auth.profile')
                ->with('success', 'Email уже подтверждён.');
        }

        // Безопасное сравнение хешей
        $expectedHash = sha1($user->getEmailForVerification());
        if (!hash_equals($expectedHash, (string) $request->route('hash'))) {
            return redirect()->route('auth.profile')
                ->withErrors(['error' => 'Неверная ссылка подтверждения email.']);
        }

        // Подтверждаем email
        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();

        return redirect()->route('auth.profile')
            ->with('success', 'Email успешно подтверждён.');
    }

    /**
     * Повторно отправляет письмо для верификации.
     */
    public function send(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('auth.profile')
                ->with('success', 'Email уже подтверждён.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Ссылка для подтверждения отправлена на вашу почту.');
    }
}