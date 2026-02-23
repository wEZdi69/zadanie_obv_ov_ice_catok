@extends('layouts.app')

@section('title', 'Оплата прошла успешно')

@section('content')
    <section class="payment-success">
        <div class="container">
            <div class="success-card">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <h1>Оплата прошла успешно!</h1>
                <p>Спасибо за покупку. Ждем вас на нашем катке!</p>
                <a href="/" class="btn btn-primary">Вернуться на главную</a>
            </div>
        </div>
    </section>
@endsection