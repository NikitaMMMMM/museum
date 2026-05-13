@extends('layouts.app')

@section('head')
    <title>Личный кабинет - Музей Колледжа</title>
@endsection

@section('content')
    @if(Auth::check())
        <div class="container" style="margin: 3rem 0;">
            <div class="profile-container">
                <aside class="profile-sidebar" style="position: fixed;">
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <div id="user-avatar">
                            <img id="avatar-preview" src="{{ asset('storage/avatars/base_avatar.jpg') }}" alt="Аватар"
                                style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid var(--text-muted); background-color: #f0f0f0;">
                        </div>
                        <div id="profile-name"
                            style="font-size: 1.25rem; font-weight: bold; color: var(--text-heading); margin-bottom: 0.25rem; width: 200px;">
                            {{ Auth::user()->name }}
                        </div>
                    </div>

                    <ul class="profile-nav">
                        <li><a href="#profile-tab" data-tab="profile" class="active">📋<strong>Профиль</strong></a></li>
                        <li><a href="#favorites_tab" data-tab="favorites">⭐ Избранное (<span id="favorites-count">0</span>)</a>
                        </li>
                        <li><a href="#history-tab" data-tab="history">👁️ История (<span id="history-count">0</span>)</a></li>
                        <li><a href="#settings-tab" data-tab="settings">⚙️ Настройки</a></li>
                    </ul>
                </aside>

                <div style="display: block; margin-left: 300px;">
                    <div id="profile-tab" class="tab-content active">
                        <h2 class="text-center" style="color: var(--text-heading);">Профиль</h2>
                        <div class="museum-card" style="padding: 2rem;">
                            <h3 id="reg-slug">{{ Auth::user()->slug }}</h3>

                            <p><strong>Дата регистрации:</strong> <span id="reg-date">{{ Auth::user()->created_at }}</span></p>
                            <p><strong>Почта:</strong> <span id="reg-email">{{ Auth::user()->email }}</span></p>
                            <p><strong>Избранных экспонатов:</strong> <span id="favorites-total">{{ 0 }}</span></p>

                            <button class="btn btn-primary mt-2">Редактировать профиль</button>
                            @if (auth()->check() && !auth()->user()->markEmailAsVerified())
                                <form method="POST" class="mt-3" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline">Отправить повторно письмо</button>
                                </form>
                            @endif

                        </div>
                    </div>

                    <div id="favorites-tab" class="tab-content">
                        <h2 class="text-center" style="color: var(--text-heading);">Мои избранные экспонаты (<span
                                id="favorites-count-header">0</span>)</h2>
                        <div class="grid" id="favorites-grid"
                            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">

                        </div>
                    </div>

                    <div id="settings-tab" class="tab-content">
                        <h2 class="text-center" style="color: var(--text-heading);">Настройки</h2>
                        <div class="museum-card" style="padding: 2rem;">
                            <h3>Смена пароля</h3>
                            <div class="form-group">
                                <label>Старый пароль</label>
                                <input type="password">
                            </div>
                            <div class="form-group">
                                <label>Новый пароль</label>
                                <input type="password">
                            </div>
                            <div class="form-group">
                                <label>Подтверждение</label>
                                <input type="password">
                            </div>
                            <button class="btn btn-primary">Сохранить</button>
                        </div>

                        <button class="mt-3 btn btn-danger">Удалить аккаунт</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection