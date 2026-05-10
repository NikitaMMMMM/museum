@extends('layouts.auth')

@section('head')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация - Музей Колледжа</title>
  <link rel="stylesheet" href="css/styles.css">
@endsection

@section('content')
  <main>
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

      <label style="display: block; margin-bottom: 2rem; font-weight: normal; cursor: pointer;">
        <input type="checkbox" required> Принимаю условия пользовательского соглашения
      </label>

      <button type="button" id="register-btn" class="btn btn-primary" style="width: 100%;">Зарегистрироваться</button>

      <div id="register-message" style="margin-top: 1rem; text-align: center;"></div>

      <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
        Уже есть аккаунт? <a href="login.html" style="color: var(--color-action-blue);">Войти</a>
      </p>
    </form>
  </main>
@endsection

@section('scripts')
  <script src="js/app.js"></script>
@endsection

