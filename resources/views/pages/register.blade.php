@extends('layouts.app')

@section('head')
    <title>Регистрация - Музей Колледжа</title>
@endsection

@section('content')
    <form class="auth-form" id="register-form">
        <h2 style="color: var(--text-heading); margin-bottom: 2rem; text-align: center;">Регистрация</h2>

        <div class="form-group">
            <label for="reg-name">Имя *</label>
            <input type="text" id="reg-name" required placeholder="Иван">
            <div class="error"></div>
        </div>

        <div class="form-group">
            <label for="reg-surname">Фамилия *</label>
            <input type="text" id="reg-surname" required placeholder="Иванов">
            <div class="error"></div>
        </div>

        <div class="form-group">
            <label for="reg-email">Email *</label>
            <input type="email" id="reg-email" required placeholder="ivan@example.com">
            <div class="error"></div>
        </div>

        <div class="form-group">
            <label for="reg-password">Пароль *</label>
            <input type="password" id="reg-password" minlength="6" required placeholder="Минимум 6 символов">
            <div class="error"></div>
        </div>

        <div class="form-group">
            <label for="reg-password-confirm">Подтверждение пароля *</label>
            <input type="password" id="reg-password-confirm" required placeholder="Повторите пароль">
            <div class="error"></div>
        </div>

        <div style="display: flex; justify-content: center; margin-bottom: 2rem;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" required style="width: 16px; height: 16px; margin: 0;">
                <span style="font-weight: normal; white-space: nowrap; font-size: 14px;">
                    Принимаю условия пользовательского соглашения
                </span>
            </label>
        </div>

        <button type="button" id="register-btn" class="btn btn-primary" style="width: 100%;">Зарегистрироваться</button>

        <div id="register-message" style="margin-top: 1rem; text-align: center;"></div>

        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
            Уже есть аккаунт? <a href="{{ route('pages.login') }}" style="color: var(--color-action-blue);">Войти</a>
        </p>
    </form>
@endsection