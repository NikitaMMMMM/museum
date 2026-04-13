// Museum Site JS - Simulates auth, favorites, tabs
class MuseumApp {
  constructor() {
    this.user = null;
    this.favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    this.viewHistory = JSON.parse(localStorage.getItem('viewHistory')) || [];
    this.init();
  }

  init() {
    this.loadUser();
    this.bindEvents();
    this.updateUI();
    
    // Auto-init profile if on profile page
    if (document.getElementById('profile-name')) {
      // Небольшая задержка для гарантии загрузки DOM
      setTimeout(() => this.initProfile(), 50);
    }
  }

  initProfile() {
    console.log('initProfile called, user:', this.user);
    
    // Проверяем авторизацию
    // if (!this.user) {
    //   console.warn('User not authenticated, redirecting to login');
    //   window.location.href = 'login.html';
    //   return;
    // }
    
    const profileName = document.getElementById('profile-name');
    if (profileName) {
      profileName.textContent = this.user.name;
      console.log('Profile name set to:', this.user.name);
    }
    
    const profileEmail = document.getElementById('profile-email');
    if (profileEmail) profileEmail.textContent = this.user.email;
    
    const regDate = document.getElementById('reg-date');
    if (regDate) {
      const date = this.user.registeredAt 
        ? new Date(this.user.registeredAt).toLocaleDateString('ru')
        : new Date().toLocaleDateString('ru');
      regDate.textContent = date;
    }
    
    // Обновляем счетчики
    this.updateCounters();
    
    // Отображаем избранное
    this.renderFavoritesGrid();
    
    // Отображаем историю
    this.renderHistoryList();
  }

  updateCounters() {
    const counters = {
      'favorites-count': this.favorites.length,
      'favorites-count-header': this.favorites.length,
      'favorites-total': this.favorites.length,
      'history-count': this.viewHistory.length,
      'views-total': this.viewHistory.length
    };
    
    Object.entries(counters).forEach(([id, value]) => {
      const el = document.getElementById(id);
      if (el) el.textContent = value;
    });
  }

  renderFavoritesGrid() {
    const favGrid = document.getElementById('favorites-grid');
    if (!favGrid) return;
    
    if (this.favorites.length === 0) {
      favGrid.innerHTML = `
        <div style="grid-column: 1/-1; padding: 3rem; text-align: center; color: var(--text-muted);">
          <p>Вы пока не добавили ни одного экспоната.</p>
          <a href="exhibits.html" class="btn btn-primary" style="margin-top: 1rem;">Перейти в каталог</a>
        </div>
      `;
      return;
    }
    
    const exhibits = window.exhibits || [];
    const favoriteExhibits = exhibits.filter(ex => 
      this.favorites.includes(String(ex.id))
    );
    
    if (favoriteExhibits.length === 0) {
      favGrid.innerHTML = `
        <div style="grid-column: 1/-1; padding: 3rem; text-align: center; color: var(--text-muted);">
          <p>Избранные экспонаты не найдены в базе</p>
        </div>
      `;
      return;
    }
    
    favGrid.innerHTML = favoriteExhibits.map(exhibit => `
      <div class="museum-card">
        <div class="card-img-wrapper" style="padding: 1rem; text-align: center; background: var(--bg-secondary);">
          <div style="font-size: 3rem;">🏛️</div>
        </div>
        <div class="card-body">
          <div class="exhibit-year">
            <i class="bi bi-calendar3"></i> ${exhibit.year} г.
          </div>
          <h3 class="exhibit-title">${exhibit.title}</h3>
          <p class="exhibit-desc">${exhibit.category || 'Экспонат музея'}</p>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
            <button class="btn-favorite active" data-id="${exhibit.id}">❤️ В избранном</button>
            <a href="exhibit.html?id=${exhibit.id}" class="btn-details">
              Подробнее <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>
    `).join('');
    
    // Обновляем состояние кнопок
    this.updateFavorites();
  }

  renderHistoryList() {
    const historyList = document.getElementById('history-list');
    if (!historyList) return;
    
    if (this.viewHistory.length === 0) {
      historyList.innerHTML = `
        <div style="grid-column: 1/-1; padding: 2rem; text-align: center; color: var(--text-muted);">
          <p>История просмотров пуста</p>
        </div>
      `;
      return;
    }
    
    const exhibits = window.exhibits || [];
    const historyItems = this.viewHistory.slice(0, 20).map(entry => {
      const exhibit = exhibits.find(e => String(e.id) === String(entry.id));
      return { ...entry, exhibit };
    });
    
    historyList.innerHTML = historyItems.map(item => `
      <div class="museum-card" style="margin-bottom: 1rem;">
        <div style="display: flex; gap: 1rem; padding: 1rem;">
          <div style="width: 60px; height: 60px; background: var(--bg-secondary); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            🏛️
          </div>
          <div style="flex: 1;">
            <a href="exhibit.html?id=${item.id}" style="color: var(--text-heading); font-weight: 500; text-decoration: none;">
              ${item.exhibit?.title || item.title || 'Экспонат'}
            </a>
            <div style="color: var(--text-muted); font-size: 0.875rem; margin-top: 0.25rem;">
              ${new Date(item.date).toLocaleString('ru')}
            </div>
          </div>
          ${item.exhibit ? `
            <button class="btn-favorite ${this.isFavorite(item.id) ? 'active' : ''}" data-id="${item.id}">
              ${this.isFavorite(item.id) ? '❤️' : '🤍'}
            </button>
          ` : ''}
        </div>
      </div>
    `).join('');
  }

  loadUser() {
    const userData = localStorage.getItem('museumUser');
    if (userData) {
      try {
        this.user = JSON.parse(userData);
        console.log('✅ User loaded from localStorage:', this.user);
      } catch (e) {
        console.error('❌ Error parsing user data:', e);
        localStorage.removeItem('museumUser');
        this.user = null;
      }
    } else {
      console.log('ℹ️ No user data in localStorage');
      this.user = null;
    }
  }

  login(email, password) {
    if (!email || !password) {
      this.showMessage('Пожалуйста, заполните все поля', 'error');
      return false;
    }

    this.user = { 
      id: 1, 
      name: email.split('@')[0] || 'Пользователь', 
      email: email,
      registeredAt: new Date().toISOString()
    };
    
    localStorage.setItem('museumUser', JSON.stringify(this.user));
    console.log('✅ User saved to localStorage:', this.user);
    
    this.updateUI();
    this.showMessage('✅ Вход выполнен успешно!', 'success');
    
    setTimeout(() => {
      window.location.href = 'profile.html';
    }, 1000);
    
    return true;
  }

  register(name, surname, email, password) {
    console.log('Register attempt:', { name, surname, email });
    
    // Валидация
    if (!name || !surname || !email || !password) {
      this.showMessage('Пожалуйста, заполните все поля', 'error');
      return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      this.showMessage('Пожалуйста, введите корректный email', 'error');
      return false;
    }

    if (password.length < 6) {
      this.showMessage('Пароль должен содержать минимум 6 символов', 'error');
      return false;
    }

    const passwordConfirm = document.getElementById('reg-password-confirm');
    if (passwordConfirm && password !== passwordConfirm.value) {
      this.showMessage('Пароли не совпадают', 'error');
      return false;
    }

    // Создаем пользователя
    this.user = { 
      id: Date.now(), 
      name: `${name} ${surname}`, 
      email: email,
      registeredAt: new Date().toISOString()
    };
    
    // Сохраняем в localStorage
    localStorage.setItem('museumUser', JSON.stringify(this.user));
    console.log('✅ New user registered and saved:', this.user);
    
    // Проверяем, что данные сохранились
    const savedUser = localStorage.getItem('museumUser');
    console.log('📦 localStorage check:', savedUser);
    
    this.updateUI();
    this.showMessage('✅ Регистрация успешна! Перенаправление...', 'success');
    
    // Перенаправляем на профиль
    setTimeout(() => {
      window.location.href = 'profile.html';
    }, 1500);
    
    return true;
  }

  logout() {
    localStorage.removeItem('museumUser');
    this.user = null;
    this.updateUI();
    this.showMessage('Вы вышли из системы', 'info');
    setTimeout(() => {
      window.location.href = 'index.html';
    }, 500);
  }

  toggleFavorite(exhibitId) {
    if (!this.user) {
      this.showAuthModal();
      return false;
    }

    const id = String(exhibitId);
    const index = this.favorites.indexOf(id);
    
    if (index > -1) {
      this.favorites.splice(index, 1);
      this.showMessage('Удалено из избранного', 'info');
    } else {
      this.favorites.push(id);
      this.showMessage('⭐ Добавлено в избранное', 'success');
    }
    
    localStorage.setItem('favorites', JSON.stringify(this.favorites));
    this.updateFavorites();
    
    // Обновляем счетчики на странице профиля
    this.updateCounters();
    
    return true;
  }

  isFavorite(exhibitId) {
    return this.favorites.includes(String(exhibitId));
  }

  addToHistory(exhibitId, title) {
    const entry = { 
      id: String(exhibitId), 
      title: title, 
      date: new Date().toISOString() 
    };
    
    this.viewHistory = this.viewHistory.filter(item => item.id !== entry.id);
    this.viewHistory.unshift(entry);
    
    if (this.viewHistory.length > 50) {
      this.viewHistory = this.viewHistory.slice(0, 50);
    }
    
    localStorage.setItem('viewHistory', JSON.stringify(this.viewHistory));
  }

  bindEvents() {
    document.addEventListener('click', (e) => {
      // Переключение вкладок
      if (e.target.matches('[data-tab]') || e.target.closest('[data-tab]')) {
        e.preventDefault();
        const tab = e.target.closest('[data-tab]');
        this.switchTab(tab.dataset.tab);
      }
      
      // Кнопка "В избранное"
      if (e.target.matches('.btn-favorite') || e.target.closest('.btn-favorite')) {
        e.preventDefault();
        const btn = e.target.closest('.btn-favorite');
        const exhibitId = btn.dataset.id;
        this.toggleFavorite(exhibitId);
      }
      
      // Выход
      if (e.target.matches('#logout-btn') || e.target.closest('#logout-btn')) {
        e.preventDefault();
        this.logout();
      }
      
      // Вход
      if (e.target.matches('#login-btn')) {
        e.preventDefault();
        const email = document.getElementById('login-email')?.value.trim();
        const password = document.getElementById('login-password')?.value;
        this.login(email, password);
      }
      
      // Регистрация
      if (e.target.matches('#register-btn')) {
        e.preventDefault();
        const name = document.getElementById('reg-name')?.value.trim();
        const surname = document.getElementById('reg-surname')?.value.trim();
        const email = document.getElementById('reg-email')?.value.trim();
        const password = document.getElementById('reg-password')?.value;
        this.register(name, surname, email, password);
      }
    });

    // Отправка по Enter
    document.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        if (e.target.closest('#login-form')) {
          document.getElementById('login-btn')?.click();
        }
        if (e.target.closest('#register-form')) {
          document.getElementById('register-btn')?.click();
        }
      }
    });
  }

  switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(tab => {
      tab.classList.remove('active');
    });
    
    document.querySelectorAll('.profile-nav a').forEach(link => {
      link.classList.remove('active');
    });
    
    const tabContent = document.getElementById(`${tabName}-tab`);
    if (tabContent) {
      tabContent.classList.add('active');
    }
    
    const activeLink = document.querySelector(`[data-tab="${tabName}"]`);
    if (activeLink) {
      activeLink.classList.add('active');
    }
  }

  updateUI() {
    const isLoggedIn = !!this.user;
    const userActions = document.querySelector('.user-actions');
    
    if (!userActions) return;
    
    if (isLoggedIn) {
      userActions.innerHTML = `
        <div class="user-menu" style="display: flex; gap: 15px; align-items: center;">
          <span class="user-name" style="color: var(--text-heading); font-weight: 500;">${this.user.name}</span>
          <a href="profile.html" class="btn btn-outline">Личный кабинет</a>
          <button id="logout-btn" class="btn btn-outline">Выйти</button>
        </div>
      `;
    } else {
      const currentPage = window.location.pathname.split('/').pop();
      
      if (currentPage === 'login.html') {
        userActions.innerHTML = `
          <div class="guest-menu" style="display: flex; gap: 10px;">
            <a href="register.html" class="btn btn-outline">Регистрация</a>
          </div>
        `;
      } else if (currentPage === 'register.html') {
        userActions.innerHTML = `
          <div class="guest-menu" style="display: flex; gap: 10px;">
            <a href="login.html" class="btn btn-outline">Войти</a>
          </div>
        `;
      } else {
        userActions.innerHTML = `
          <div class="guest-menu" style="display: flex; gap: 10px;">
            <a href="login.html" class="btn btn-outline">Войти</a>
            <a href="register.html" class="btn btn-primary">Регистрация</a>
          </div>
        `;
      }
    }
  }

  updateFavorites() {
    document.querySelectorAll('.btn-favorite').forEach(btn => {
      const id = btn.dataset.id;
      if (this.isFavorite(id)) {
        btn.classList.add('active');
        btn.innerHTML = '❤️ В избранном';
      } else {
        btn.classList.remove('active');
        btn.innerHTML = '🤍 В избранное';
      }
    });
  }

  showMessage(text, type = 'info') {
    const colors = {
      success: '#10b981',
      error: '#ef4444',
      info: 'var(--color-action-blue)',
      warning: '#f59e0b'
    };
    
    const toast = document.createElement('div');
    toast.textContent = text;
    toast.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${colors[type] || colors.info};
      color: white;
      padding: 1rem 1.5rem;
      border-radius: 8px;
      z-index: 10000;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    
    document.body.appendChild(toast);
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transition = 'opacity 0.3s';
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  }

  showAuthModal() {
    this.showMessage('Войдите в аккаунт, чтобы добавлять в избранное', 'warning');
    setTimeout(() => {
      window.location.href = 'login.html';
    }, 1500);
  }
}

// Инициализация
let app;
document.addEventListener('DOMContentLoaded', () => {
  app = new MuseumApp();
  console.log('✅ MuseumApp initialized');
});

// Демо-данные
window.news = [
  { 
    id: 1, 
    title: 'Открыта новая Экспонаты "В годы войны"', 
    date: '2026-10-15',
    excerpt: 'Посетите уникальные документы 1941-1945 годов из фондов музея.',
    img: '📰'
  },
  { 
    id: 2, 
    title: 'Мастер-класс: реставрация старинных книг', 
    date: '2026-10-20',
    excerpt: 'Бесплатный мастер-класс 25 октября для всех желающих.',
    img: '📚'
  },
  { 
    id: 3, 
    title: 'Новая публикация о истории колледжа', 
    date: '2026-10-10',
    excerpt: 'Вышла книга "100 лет педагогического мастерства". Доступна в библиотеке.',
    img: '📖'
  },
  {
    id: 4,
    title: 'Онлайн-экскурсия по музею',
    date: '2026-10-05',
    excerpt: 'Запись трансляции доступна в нашем YouTube-канале.',
    img: '📹'
  },
  {
    id: 5,
    title: 'Конкурс "Мой любимый экспонат"',
    date: '2026-09-28',
    excerpt: 'Голосуйте за лучший экспонат месяца! Призы для победителей.',
    img: '🏆'
  }
];

window.exhibits = [
  { id: 1, title: 'Диплом X года', year: 1000, category: 'Документы' },
  { id: 2, title: 'Фотография коллектива', year: 1000, category: 'Фотографии' },
  { id: 3, title: 'Старый микроскоп', year: 1000, category: 'Приборы' },
  { id: 4, title: 'Учебник по физике', year: 1000, category: 'Книги' },
  { id: 5, title: 'Печатная машинка Ундервуд', year: 1000, category: 'Оборудование' },
];
