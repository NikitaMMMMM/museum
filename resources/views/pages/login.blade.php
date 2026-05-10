@extends('layouts.app')

@section('head')
    <title>Вход - Музей Колледжа</title>
@endsection

@section('content')
    <form class="auth-form" id="login-form">
        <h2 style="color: var(--text-heading); margin-bottom: 2rem; text-align: center;">Вход в личный кабинет</h2>

        <div class="form-group">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" required placeholder="user@example.com">
            <div class="error" id="login-email-error"></div>
        </div>

        <div class="form-group">
            <label for="login-password">Пароль</label>
            <input type="password" id="login-password" required placeholder="Пароль">
            <div class="error" id="login-password-error"></div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <label style="font-weight: normal; cursor: pointer;">
                <input type="checkbox"> Запомнить меня
            </label>
            <a href="#" style="color: var(--color-action-blue); font-size: 0.875rem;">Забыли пароль?</a>
        </div>

        <button type="button" id="login-btn" class="btn btn-primary" style="width: 100%;">Войти</button>

        <div id="login-message" style="margin-top: 1rem; text-align: center;"></div>

        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
            Нет аккаунта? <a href="register.html" style="color: var(--color-action-blue);">Зарегистрироваться</a>
        </p>

        <div
            style="margin-top: 2rem; padding: 1rem; background: var(--bg-secondary); border-radius: 8px; font-size: 0.875rem;">
            <p style="color: var(--text-muted); margin: 0;">
                <strong>Демо-доступ:</strong><br>
                Любой email и пароль (минимум 1 символ)
            </p>
        </div>
    </form>
@endsection