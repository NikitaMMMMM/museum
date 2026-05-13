<header>
    <nav class="container header-content">
        <div class="logo">Музей Колледжа</div>

        <ul class="nav">
            <li><a href="{{ route('pages.index') }}">Главная</a></li>
            <li><a href="{{ route('exhibits.index') }}">Экспонаты</a></li>
            <li><a href="{{ route('pages.history') }}">История</a></li>
            <li><a href="{{ route('pages.about') }}">О музее</a></li>
        </ul>

        <div class="user-actions">
            <div class="user-menu" style="display: flex; gap: 1rem;">
                @if (Auth::check())
                    <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Выйти</button>
                    </form>
                    <a href="{{ route('auth.profile') }}" class="btn btn-primary">Личный кабинет</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Войти</a>
                    <a href="{{ route('register.show') }}" class="btn btn-primary">Регистрация</a>
                @endif
            </div>
        </div>
    </nav>
</header>