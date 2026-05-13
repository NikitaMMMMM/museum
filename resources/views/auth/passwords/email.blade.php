@extends('layouts.app')

@section('head')
    <title>Восстановление пароля</title>
@endsection

@section('content')
    <h2 style="text-align:center; color: var(--text-heading); margin-bottom: 2rem;">Восстановление пароля</h2>

    @if (session('status'))
        <div style="margin-bottom: 1rem; color: var(--text-success);">{{ session('status') }}</div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="error" style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit" style="width:100%; margin-top: 1rem;">Отправить ссылку</button>
    </form>
@endsection

