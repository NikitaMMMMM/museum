@extends('layouts.app')

@section('head')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Экспонаты - Музей Колледжа</title>
  <link rel="stylesheet" href="css/styles.css">
@endsection

@section('content')
  <div style="margin: 2rem 0;">
    <h1 style="color: var(--text-heading); font-size: 2.5rem;">Экспонаты музея</h1>
  </div>

  <div class="filters">
    <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
      <div style="flex: 1; min-width: 200px;">
        <label>Поиск</label>
        <input type="search" placeholder="Название экспоната, ключевые слова...">
      </div>
      <select>
        <option>Категория: Все</option>
        <option>Документы</option>
        <option>Фотографии</option>
      </select>
      <select>
        <option>Сортировка: По дате</option>
        <option>По названию</option>
      </select>
    </div>
  </div>

  <div class="grid" id="exhibits-grid"></div>

  <div style="text-align: center; margin: 3rem 0;">
    <div style="display: inline-flex; gap: 0.5rem; align-items: center;">
      <button class="btn btn-outline">Предыдущая</button>
      <span style="padding: 0.5rem 1rem; background: var(--color-action-blue); color: white; border-radius: var(--radius);">1</span>
      <button class="btn btn-outline">Следующая</button>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="js/app.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const grid = document.getElementById('exhibits-grid');
      (window.exhibits || []).forEach(exhibit => {
        const card = document.createElement('div');
        card.className = 'museum-card';
        card.innerHTML = `
          <div class="card-img">📷 ${exhibit.category}</div>
          <div class="card-content">
            <h3 class="card-title">${exhibit.title}</h3>
            <div class="card-meta">${exhibit.year} год • ${exhibit.category}</div>
            <button class="btn btn-favorite" data-id="${exhibit.id}">☆</button>
            <a href="exhibit.html?id=${exhibit.id}" class="btn btn-primary" style="margin-top: 1rem; width: 100%;">Подробнее</a>
          </div>
        `;
        grid.appendChild(card);
      });
      app.updateFavorites();
    });
  </script>
@endsection

