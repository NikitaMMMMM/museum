@extends('layouts.app')

@section('head')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Личный кабинет - Музей Колледжа</title>
  <link rel="stylesheet" href="css/styles.css">
@endsection

@section('content')
  <div class="container" style="margin: 3rem 0;">
    <div class="profile-container" style="display: grid; grid-template-columns: 300px 1fr; gap: 3rem;">
      <aside class="profile-sidebar">
        <div style="text-align: center; margin-bottom: 2rem;">
          <div id="user-avatar" style="width: 80px; height: 80px; background: var(--color-brand-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold; margin: 0 auto 1rem;">ИИ</div>
          <div id="profile-name" style="font-size: 1.25rem; font-weight: bold; color: var(--text-heading); margin-bottom: 0.25rem;">Загрузка...</div>
          <div id="profile-email" class="user-email" style="color: var(--text-muted); font-size: 0.875rem;"></div>
        </div>

        <ul class="profile-nav">
          <li><a href="#" data-tab="profile" class="active">📋 Профиль</a></li>
          <li><a href="#" data-tab="favorites">⭐ Избранное (<span id="favorites-count">0</span>)</a></li>
          <li><a href="#" data-tab="history">👁️ История (<span id="history-count">0</span>)</a></li>
          <li><a href="#" data-tab="settings">⚙️ Настройки</a></li>
        </ul>
      </aside>

      <div>
        <div id="profile-tab" class="tab-content active">
          <h1 style="color: var(--text-heading);">Профиль</h1>
          <div class="museum-card" style="padding: 2rem;">
            <p><strong>Дата регистрации:</strong> <span id="reg-date"></span></p>
            <p><strong>Избранных экспонатов:</strong> <span id="favorites-total">0</span></p>
            <p><strong>Просмотров:</strong> <span id="views-total">0</span></p>
            <button class="btn btn-primary" style="margin-top: 1rem;">Редактировать профиль</button>
          </div>
        </div>

        <div id="favorites-tab" class="tab-content">
          <h1 style="color: var(--text-heading);">Мои избранные экспонаты (<span id="favorites-count-header">0</span>)</h1>
          <div class="grid" id="favorites-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
          </div>
        </div>

        <div id="history-tab" class="tab-content">
          <h1 style="color: var(--text-heading);">История просмотров</h1>
          <div id="history-list"></div>
          <button class="btn btn-outline" style="margin-top: 2rem;" onclick="app.viewHistory = []; localStorage.setItem('viewHistory', '[]'); app.renderHistoryList();">Очистить историю</button>
        </div>

        <div id="settings-tab" class="tab-content">
          <h1 style="color: var(--text-heading);">Настройки</h1>
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

          <div class="museum-card" style="padding: 2rem; margin-top: 2rem;">
            <h3>Уведомления</h3>
            <label><input type="checkbox" checked> Новые экспонаты в избранных категориях</label><br>
            <label><input type="checkbox"> Новости музея</label>
          </div>

          <button class="btn btn-outline" style="background: #dc3545; color: white; border-color: #dc3545; margin-top: 2rem;">Удалить аккаунт</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="js/app.js"></script>
@endsection

