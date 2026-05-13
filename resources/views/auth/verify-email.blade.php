@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Подтвердите Email</h2>
    <p>Пожалуйста, проверьте вашу почту и перейдите по ссылке для подтверждения.</p>
    <p>Если письмо не пришло, нажмите кнопку ниже для повторной отправки.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Отправить повторно</button>
    </form>
</div>
@endsection