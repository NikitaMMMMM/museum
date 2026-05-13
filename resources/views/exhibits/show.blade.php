{{-- @extends('layouts.app')

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
@endsection --}}

@extends('layouts.app') {{-- Или ваш основной лейаут --}}

@section('title', $exhibit->name ?? 'Информация об экспонате')

@section('content')
{{-- Подключение стилей (можно вынести в отдельный CSS файл) --}}
<style>
    :root {
        --text-heading: #1a1a1a;
        --text-body: #4a4a4a;
        --text-muted: #888888;
        --color-action-blue: #007bff;
        --bg-light: #f8f9fa;
        --border-color: #e0e0e0;
        --shadow-card: 0 4px 12px rgba(0,0,0,0.08);
    }

    .exhibit-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
        font-family: system-ui, -apple-system, sans-serif;
        color: var(--text-body);
    }

    /* Навигация */
    .exhibit-breadcrumb {
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        color: var(--text-muted);
    }
    .exhibit-breadcrumb a {
        color: var(--color-action-blue);
        text-decoration: none;
    }
    .exhibit-breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Основная сетка */
    .exhibit-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: var(--shadow-card);
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .exhibit-grid {
            grid-template-columns: 1.2fr 1fr;
        }
    }

    /* Галерея изображений */
    .exhibit-gallery {
        background: var(--bg-light);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .main-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 75%; /* Соотношение 4:3 */
        overflow: hidden;
        border-radius: 8px;
        background: #fff;
        cursor: zoom-in;
    }

    .main-image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .thumbnails {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .thumb {
        width: 80px;
        height: 80px;
        border-radius: 6px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        opacity: 0.7;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .thumb:hover, .thumb.active {
        border-color: var(--color-action-blue);
        opacity: 1;
    }

    /* Информация */
    .exhibit-info {
        padding: 2rem;
        display: flex;
        flex-direction: column;
    }

    .exhibit-header {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1rem;
    }

    .exhibit-title {
        color: var(--text-heading);
        font-size: 2rem;
        margin: 0 0 0.5rem 0;
        line-height: 1.2;
    }

    .exhibit-meta {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .exhibit-description {
        line-height: 1.6;
        margin-bottom: 2rem;
        flex-grow: 1;
    }

    .specs-list {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem 0;
        background: var(--bg-light);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .specs-list li {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #eee;
    }
    .specs-list li:last-child {
        border-bottom: none;
    }
    .spec-label {
        font-weight: 600;
        color: var(--text-heading);
    }
    .spec-value {
        color: var(--text-body);
        text-align: right;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: auto;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: opacity 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .btn-primary {
        background-color: var(--color-action-blue);
        color: white;
    }
    .btn-outline {
        background-color: transparent;
        border: 1px solid var(--color-action-blue);
        color: var(--color-action-blue);
    }
    .btn:hover {
        opacity: 0.9;
    }

    /* Модальное окно для зума */
    .image-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .image-modal.show {
        display: flex;
        opacity: 1;
    }
    .modal-content {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }
    .close-modal {
        position: absolute;
        top: 20px;
        right: 30px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<div class="exhibit-container">
    {{-- Хлебные крошки --}}
    <div class="exhibit-breadcrumb">
        <a href="{{ route('pages.index') }}">Главная</a> 
        / <a href="{{ route('exhibits.index') }}">Экспонаты</a> 
        {{-- / <span>{{ $exhibit->name }}</span> --}}
    </div>

    <div class="exhibit-grid">
        {{-- Левая колонка: Галерея --}}
        <div class="exhibit-gallery">
            <div class="main-image-wrapper" id="mainImageWrapper">
                {{-- <img src="{{ $exhibit->getMainImageUrl() }}" alt="{{ $exhibit->name }}" id="mainImage"> --}}
            </div>
            
            {{-- @if($exhibit->images->count() > 1)
            <div class="thumbnails">
                @foreach($exhibit->images as $image)
                    <img src="{{ $image->getUrl() }}" 
                         alt="Фото {{ $loop->iteration }}" 
                         class="thumb {{ $loop->first ? 'active' : '' }}"
                         onclick="changeImage(this, '{{ $image->getUrl() }}')">
                @endforeach
            </div>
            @endif --}}
        </div>

        {{-- Правая колонка: Информация --}}
        <div class="exhibit-info">
            <div class="exhibit-header">
                {{-- <h1 class="exhibit-title">{{ $exhibit->name }}</h1> --}}
                <div class="exhibit-meta">
                    <span class="meta-item">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                        ID: {{-- {{ $exhibit->id }} --}}
                    </span>
                    {{-- @if($exhibit->year)
                    <span class="meta-item">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                        {{ $exhibit->year }} г.
                    </span>
                    @endif --}}
                    <span class="meta-item">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                        {{-- {{ $exhibit->location ?? 'Зал №1' }} --}}
                    </span>
                </div>
            </div>

            <div class="exhibit-description">
                {{-- <p>{{ $exhibit->description }}</p> --}}
            </div>

            {{-- @if($exhibit->specifications)
            <ul class="specs-list">
                @foreach($exhibit->specifications as $key => $value)
                    <li>
                        <span class="spec-label">{{ $key }}</span>
                        <span class="spec-value">{{ $value }}</span>
                    </li>
                @endforeach
            </ul>
            @endif --}}

            <div class="action-buttons">
                <button class="btn btn-primary" onclick="alert('Функция бронирования билета скоро будет доступна!')">
                    Купить билет
                </button>
                <button class="btn btn-outline" onclick="shareExhibit()">
                    Поделиться
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Модальное окно для просмотра изображения --}}
<div id="imageModal" class="image-modal" onclick="closeModal()">
    <span class="close-modal">&times;</span>
    <img class="modal-content" id="modalImg">
</div>

<script>
    // Данные из Blade в JS
    const exhibitData = {
        title: '', //",
        url: ''
    };

    // Смена основного изображения
    function changeImage(thumb, src) {
        const mainImg = document.getElementById('mainImage');
        
        // Анимация смены
        mainImg.style.opacity = '0';
        
        setTimeout(() => {
            mainImg.src = src;
            mainImg.onload = () => {
                mainImg.style.opacity = '1';
            };
        }, 200);

        // Обновление активного класса
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }

    // Зум изображения
    const mainImageWrapper = document.getElementById('mainImageWrapper');
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');

    mainImageWrapper.addEventListener('click', () => {
        const src = document.getElementById('mainImage').src;
        modal.classList.add('show');
        modalImg.src = src;
    });

    function closeModal() {
        modal.classList.remove('show');
    }

    // Закрытие по Esc
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });

    // Функция поделиться
    function shareExhibit() {
        if (navigator.share) {
            navigator.share({
                title: exhibitData.title,
                url: exhibitData.url
            }).catch(console.error);
        } else {
            // Фоллбэк: копирование в буфер
            navigator.clipboard.writeText(exhibitData.url).then(() => {
                alert('Ссылка скопирована в буфер обмена!');
            });
        }
    }
</script>
@endsection