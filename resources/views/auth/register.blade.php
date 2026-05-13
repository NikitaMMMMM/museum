@extends('layouts.app')

@section('head')
    <title>Регистрация - Музей Колледжа</title>
@endsection

@section('content')
    <div class="auth-container">
        <form class="auth-form" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h2 style="color: var(--text-heading); margin-bottom: 2rem; text-align: center;">Регистрация</h2>

            <div class="form-group" style="text-align: center; margin-bottom: 1.5rem;">
                <label for="avatar_url" style="cursor: pointer; display: inline-block;">
                    <img id="avatar-preview" src="{{ asset('storage/avatars/base_avatar.jpg') }}" alt="Аватар"
                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid var(--text-muted); background-color: #f0f0f0;">
                    <input type="file" id="avatar_url" name="avatar_url" accept="image/*" style="display: none;"
                        onchange="previewAvatar(this)">
                </label>
                <div style="font-size: 12px; color: var(--text-muted); margin-top: 5px;">Нажмите, чтобы загрузить фото</div>

                @error('avatar_url')
                    <div class="error" style="color: red; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="reg-name">ФИО *</label>
                <input type="text" id="reg-name" name="name" value="{{ old('name') }}" required autofocus
                    placeholder="Иванов Иван Иванович" class="@error('name') is-invalid @enderror">

                @error('name')
                    <div class="error" style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="reg-email">Email *</label>
                <input type="email" id="reg-email" name="email" value="{{ old('email') }}" required
                    placeholder="ivan@example.com" class="@error('email') is-invalid @enderror">

                @error('email')
                    <div class="error" style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="reg-password">Пароль *</label>
                <input type="password" id="reg-password" name="password" required minlength="8"
                    placeholder="Минимум 8 символов" class="@error('email') is-invalid @enderror"
                    value="{{ old('password') }}">
                <small style="font-size: 11px; color: var(--text-muted);">Латиница, цифры, заглавные буквы, спец.
                    символы</small>

                @error('password')
                    <div class="error" style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="reg-password-confirm">Подтверждение пароля *</label>
                <input type="password" id="reg-password-confirm" name="password_confirmation" required
                    placeholder="Повторите пароль">
            </div>

            <div style="display: flex; justify-content: center; margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="agreement" id="agreement" required
                        style="width: 16px; height: 16px; margin: 0;" class="@error('agreement') is-invalid @enderror">
                    <span style="font-weight: normal; white-space: nowrap; font-size: 14px;">
                        Принимаю условия пользовательского соглашения
                    </span>
                </label>
            </div>

            @error('agreement')
                <div class="error" style="text-align: center; color: red; font-size: 13px; margin-bottom: 1rem;">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn btn-primary" style="width: 100%;">Зарегистрироваться</button>

            @if (session('success'))
                <div style="margin-top: 1rem; text-align: center; color: green; font-weight: bold;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->has('error'))
                <div style="margin-top: 1rem; text-align: center; color: red; font-weight: bold;">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
                Уже есть аккаунт? <a href="{{ route('login') }}" style="color: var(--color-action-blue);">Войти</a>
            </p>
        </form>
    </div>

    {{-- Минимальный скрипт ТОЛЬКО для предпросмотра картинки (UX), без отправки формы --}}
    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                    document.getElementById('avatar-preview').style.borderColor = 'var(--color-action-blue)';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection