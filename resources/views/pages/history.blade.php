@extends('layouts.app')

@section('head')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>История колледжа - Музей Колледжа</title>
  <link rel="stylesheet" href="css/styles.css">
@endsection

@section('content')
  <h1 style="color: var(--text-heading); text-align: center; margin: 3rem 0 2rem;">История колледжа</h1>

  <div class="timeline">
    <div class="timeline-item">
      <div class="timeline-content">
        <h3>Год основания</h3>
        <p>Основание учебного заведения. Первые дипломы.</p>
        <a href="exhibits.html">Экспонаты этого периода (5)</a>
      </div>
    </div>

    <div class="timeline-item">
      <div class="timeline-content">
        <h3>Год события</h3>
        <p>Описание события</p>
        <a href="exhibit.html?id=5">Экспонаты этого периода (8)</a>
      </div>
    </div>

    <div class="timeline-item">
      <div class="timeline-content">
        <h3>1991</h3>
        <p>Переход к новой системе образования.</p>
        <a href="exhibits.html">Экспонаты этого периода (15)</a>
      </div>
    </div>

    <div class="timeline-item">
      <div class="timeline-content">
        <h3>2026</h3>
        <p>Создание виртуального музея.</p>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="js/app.js"></script>
@endsection

