@extends('layouts.app')

@section('head')
    <title>Главная - Музей Колледжа</title>
@endsection

@section('content')
    <!-- Hero -->
    <section class="hero">
        <h1>Виртуальный музей колледжа</h1>
        <p>Погрузитесь в историю через подлинные экспонаты</p>
        <a href="{{ route('pages.exhibits') }}" class="btn btn-primary">Перейти к экспозиции</a>
    </section>

    <!-- О музее -->
    <section>
        <a href="{{ route('pages.about') }}" style="text-decoration: none; color: inherit;">
            <div class="museum-card">
                <div class="card-content">
                    <h2 style="color: var(--text-heading); margin-bottom: 1rem;">О музее</h2>
                    <p>Коллекция насчитывает более 500 подлинных экспонатов, отражающих историю колледжа. И тд...</p>
                </div>
            </div>
        </a>
    </section>

    <!-- Новости -->
    <section>
        <h2 style="color: var(--text-heading); text-align: center; margin: 3rem 0 2rem;">Новости музея</h2>
        <div class="grid" id="featured-grid">
            <div class="museum-card">
                <div class="card-img">${newsItem.img}</div>
                <div class="card-content">
                    <h3 class="card-title">${newsItem.title}</h3>
                    <div class="card-meta">${newsItem.date}</div>
                    <p style="color: var(--text-muted); margin: 0.5rem 0;">${newsItem.excerpt}</p>
                    <a href="#"
                        style="display: block; margin-top: 1rem; color: var(--color-action-blue); font-weight: 500;">Читать
                        полностью →</a>
                </div>
            </div>
            <div class="museum-card">
                <div class="card-img">${newsItem.img}</div>
                <div class="card-content">
                    <h3 class="card-title">${newsItem.title}</h3>
                    <div class="card-meta">${newsItem.date}</div>
                    <p style="color: var(--text-muted); margin: 0.5rem 0;">${newsItem.excerpt}</p>
                    <a href="#"
                        style="display: block; margin-top: 1rem; color: var(--color-action-blue); font-weight: 500;">Читать
                        полностью →</a>
                </div>
            </div>
            <div class="museum-card">
                <div class="card-img">${newsItem.img}</div>
                <div class="card-content">
                    <h3 class="card-title">${newsItem.title}</h3>
                    <div class="card-meta">${newsItem.date}</div>
                    <p style="color: var(--text-muted); margin: 0.5rem 0;">${newsItem.excerpt}</p>
                    <a href="#"
                        style="display: block; margin-top: 1rem; color: var(--color-action-blue); font-weight: 500;">Читать
                        полностью →</a>
                </div>
            </div>
            <div class="museum-card">
                <div class="card-img">${newsItem.img}</div>
                <div class="card-content">
                    <h3 class="card-title">${newsItem.title}</h3>
                    <div class="card-meta">${newsItem.date}</div>
                    <p style="color: var(--text-muted); margin: 0.5rem 0;">${newsItem.excerpt}</p>
                    <a href="#"
                        style="display: block; margin-top: 1rem; color: var(--color-action-blue); font-weight: 500;">Читать
                        полностью →</a>
                </div>
            </div>
            <div class="museum-card">
                <div class="card-img">${newsItem.img}</div>
                <div class="card-content">
                    <h3 class="card-title">${newsItem.title}</h3>
                    <div class="card-meta">${newsItem.date}</div>
                    <p style="color: var(--text-muted); margin: 0.5rem 0;">${newsItem.excerpt}</p>
                    <a href="#"
                        style="display: block; margin-top: 1rem; color: var(--color-action-blue); font-weight: 500;">Читать
                        полностью →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- История колледжа -->
    <section>
        <div style="background: var(--bg-secondary); padding: 3rem; border-radius: var(--radius); text-align: center;">
            <h2 style="color: var(--text-heading);">История колледжа</h2>
            <p>От основания до наших дней</p>
            <a href="{{ route('pages.history') }}" class="btn btn-primary">Узнать больше</a>
        </div>
    </section>

    <!-- Призыв к регистрации -->
    <section
        style="background: var(--bg-card); padding: 3rem; border-radius: var(--radius); box-shadow: var(--shadow-card);">
        <h2 style="color: var(--text-heading);">Сохраняйте экспонаты в избранное</h2>
        <p>Войдите или зарегистрируйтесь для доступа к личному кабинету</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('pages.login') }}" class="btn btn-primary">Войти</a>
            <a href="{{ route('register.show') }}" class="btn btn-outline">Регистрация</a>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.site-footer')
@endsection

@section('scripts')
    <script>
        // Populate news
        document.addEventListener('DOMContentLoaded', () => {
            const grid = document.getElementById('featured-grid');
            (window.news || []).slice(0, 4).forEach(newsItem => {
                const card = document.createElement('div');
                card.className = 'museum-card';
                card.innerHTML = `
                      <div class="card-img">${newsItem.img}</div>
                      <div class="card-content">
                        <h3 class="card-title">${newsItem.title}</h3>
                        <div class="card-meta">${newsItem.date}</div>
                        <p style="color: var(--text-muted); margin: 0.5rem 0;">${newsItem.excerpt}</p>
                        <a href="#" style="display: block; margin-top: 1rem; color: var(--color-action-blue); font-weight: 500;">Читать полностью →</a>
                      </div>
                    `;
                grid.appendChild(card);
            });
        });
    </script>
@endsection