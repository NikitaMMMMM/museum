@extends('layouts.app')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Экспонат - Музей Колледжа</title>
    <link rel="stylesheet" href="css/styles.css">
@endsection

@section('content')
    <nav style="margin: 2rem 0; color: var(--text-muted);" aria-label="Хлебные крошки">
        <a href="index.html">Главная</a> / <a href="exhibits.html">Экспонаты</a> / <span id="exhibit-title">Название</span>
    </nav>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
        <div>
            <h1 id="exhibit-main-title" style="color: var(--text-heading); font-size: 2.5rem; margin-bottom: 1rem;"></h1>
            <div style="color: var(--text-muted); margin-bottom: 2rem; font-size: 1.125rem;">
                <span id="exhibit-year"></span> • Материал, размеры • Инв. №
            </div>

            <div class="museum-card"
                style="height: 400px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--text-muted);">
                Основное изображение
            </div>

            <div style="display: flex; gap: 1rem; margin: 2rem 0;">
                <button class="btn btn-favorite" data-id="1" id="main-favorite" style="font-size: 1.5rem;">☆</button>
                <button class="btn btn-outline"
                    onclick="navigator.share?.({title: document.title, url: window.location.href}) || alert('Ссылка скопирована')">Поделиться</button>
            </div>
        </div>

        <div>
            <h2 style="color: var(--text-heading); margin-bottom: 1rem;">Описание</h2>
            <p id="exhibit-description" style="font-size: 1.125rem;">Подробное описание экспоната...</p>

            <div class="museum-card" style="margin-top: 2rem;">
                <h3 style="color: var(--text-heading);">История предмета</h3>
                <p>Происхождение, даритель, связь с историей колледжа.</p>
            </div>
        </div>
    </div>

    <section style="margin-top: 4rem;">
        <h2 style="color: var(--text-heading);">Похожие экспонаты</h2>
        <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="museum-card">
                <div class="card-img">📷</div>
                <div class="card-content">
                    <h3 class="card-title">Похожий экспонат 1</h3>
                    <div class="card-meta">1950</div>
                </div>
            </div>
            <div class="museum-card">
                <div class="card-img">📷</div>
                <div class="card-content">
                    <h3 class="card-title">Похожий экспонат 2</h3>
                    <div class="card-meta">1960</div>
                </div>
            </div>
            <div class="museum-card">
                <div class="card-img">📷</div>
                <div class="card-content">
                    <h3 class="card-title">Похожий экспонат 3</h3>
                    <div class="card-meta">1970</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const id = parseInt(urlParams.get('id')) || 1;
            const exhibit = window.exhibits.find(e => e.id === id) || window.exhibits[0];

            document.getElementById('exhibit-title').textContent = exhibit.title;
            document.getElementById('exhibit-main-title').textContent = exhibit.title;
            document.getElementById('exhibit-year').textContent = exhibit.year;
            document.getElementById('exhibit-description').textContent = `Полное описание экспоната "${exhibit.title}". Историческая справка, контекст создания в ${exhibit.year} году.`;

            app.addToHistory(exhibit.id, exhibit.title);
            app.updateFavorites();

            document.getElementById('main-favorite').dataset.id = exhibit.id.toString();
        });
    </script>
@endsection