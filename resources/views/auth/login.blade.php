@extends('layouts.app')
@php
    dump(session()->all(), $errors->all())
@endphp
@section('head')
    <title>Вход - Музей Колледжа</title>
@endsection

@section('content')
<form class="auth-form" id="login-form" action="{{ route('login.store') }}" method="POST">
    @csrf
    <h2 style="color: var(--text-heading); margin-bottom: 2rem; text-align: center;">Вход в личный кабинет</h2>

    <div class="form-group">
        <label for="login-email">Email</label>
        <input type="email" id="login-email" name="email" required placeholder="user@example.com"
               value="{{ old('email') }}">
        <div class="error" id="login-email-error">
            @error('email') {{ $message }} @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="login-password">Пароль</label>
        <input type="password" id="login-password" name="password" required placeholder="Пароль">
        <div class="error" id="login-password-error">
            @error('password') {{ $message }} @enderror
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <a href="{{ route('login.store') }}" style="color: var(--color-action-blue); font-size: 0.875rem; text-decoration: none;" aria-hidden="true"></a>
        <a href="{{ route('password.request') }}" style="color: var(--color-action-blue); font-size: 0.875rem;">Забыли пароль?</a>
    </div>

    <button type="submit" id="login-btn" class="btn btn-primary" style="width: 100%;">Войти</button>

    <div id="login-message" style="margin-top: 1rem; text-align: center;">
        @if (session('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif
    </div>

    <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
        Нет аккаунта? <a href="{{ route('register.show') }}" style="color: var(--color-action-blue);">Зарегистрироваться</a>
    </p>
</form>
@endsection