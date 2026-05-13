@extends('layouts.app')

@section('head')
    <title>Смена пароля</title>
@endsection

@section('content')
    <h2 style="text-align:center; color: var(--text-heading); margin-bottom: 2rem;">Смена пароля</h2>

    <form class="auth-form" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group">
            <label for="password">Новый пароль</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div class="error" style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Подтверждение</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button class="btn btn-primary" type="submit" style="width:100%; margin-top: 1rem;">Сменить пароль</button>
    </form>
@endsection

