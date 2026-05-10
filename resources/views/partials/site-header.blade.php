<header>
  <nav class="container header-content">
    <div class="logo">🏛️ Музей Колледжа</div>
    <ul class="nav">
      <li><a href="{{ route('pages.index') }}">Главная</a></li>
      <li><a href="{{ route('pages.exhibits') }}">Экспонаты</a></li>
      <li><a href="history.html">История</a></li>
      <li><a href="about.html">О музее</a></li>
    </ul>
    <div class="user-actions">
      <div class="user-menu" style="display: flex; gap: 1rem;">
        <a href="login.html" class="btn btn-outline">Войти</a>
        <a href="register.html" class="btn btn-primary">Регистрация</a>
      </div>
      <div class="profile-menu" style="display: none;">
        <span class="user-name"></span>
        <button id="logout-btn" class="btn btn-outline">Выход</button>
      </div>
    </div>
  </nav>
</header>

