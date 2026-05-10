@extends('layouts.app')

@section('head')
    <title>О музее - Музей Колледжа</title>
@endsection

@section('content')
    <h1 style="color: var(--text-heading); text-align: center; margin: 3rem 0 2rem;">О музее</h1>

    <div class="museum-card" style="padding: 3rem; text-align: center;">
        <h2 style="color: var(--text-heading);">История создания</h2>
        <p>Виртуальный музей создан для сохранения и демонстрации исторического наследия колледжа. Коллекция экспонаты с
            момента основания учебного заведения.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 3rem 0;">
        <div class="museum-card" style="padding: 2rem; text-align: center;">
            <h3 style="color: var(--text-heading);">Команда</h3>
            <p>Историки, реставраторы, IT-специалисты</p>
        </div>
        <div class="museum-card" style="padding: 2rem; text-align: center;">
            <h3 style="color: var(--text-heading);">Контакты</h3>
            <p>📧 museum@college.ru<br>☎️ +7 (XXX) XXX-XX-XX</p>
        </div>
        <div class="museum-card" style="padding: 2rem; text-align: center;">
            <h3 style="color: var(--text-heading);">Адрес</h3>
            <p>г. Барнаул, ул. Горно-Алтайская, 17<br>Работает: Пн-Пт 9:00-17:00</p>
        </div>
    </div>

    <div class="museum-card" style="padding: 2rem;">
        <h3 style="color: var(--text-heading);">Карта проезда</h3>
        <div
            style="height: 300px; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; border-radius: var(--radius);">
            🗺️ Карта проезда (интеграция с Яндекс.Картами / Google Maps)
        </div>
    </div>
@endsection