@extends('layouts.app')

@section('title', 'Ледовый каток - Главная')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Добро пожаловать на ледовый каток IceArena</h1>
                <p>Лучшее место для активного отдыха всей семьей</p>
                <div class="hero-buttons">
                    <a href="{{ route('ticket.form') }}" class="btn btn-primary">Купить билет</a>
                    <a href="{{ route('booking.form') }}" class="btn btn-secondary">Забронировать коньки</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Prices Section -->
    <section id="prices" class="prices">
        <div class="container">
            <h2 class="section-title">Наши цены</h2>
            <div class="prices-grid">
                <div class="price-card">
                    <h3>Входной билет</h3>
                    <p class="price">300₽</p>
                    <ul>
                        <li>Неограниченное время</li>
                        <li>Раздевалка</li>
                        <li>Бесплатная парковка</li>
                    </ul>
                    <a href="{{ route('ticket.form') }}" class="btn btn-primary">Купить</a>
                </div>
                <div class="price-card">
                    <h3>Аренда коньков</h3>
                    <p class="price">150₽/час</p>
                    <ul>
                        <li>Профессиональные коньки</li>
                        <li>Размеры от 30 до 47</li>
                        <li>Термоформовка</li>
                    </ul>
                    <a href="{{ route('booking.form') }}" class="btn btn-secondary">Забронировать</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Skates Section -->
    <section id="skates" class="skates">
        <div class="container">
            <h2 class="section-title">Наши коньки</h2>
            <div class="skates-grid">
                @forelse($skates as $skate)
                    <div class="skate-card">
                        @if($skate->image)
                            <img src="{{ asset('storage/' . $skate->image) }}" alt="{{ $skate->model }}" class="skate-image">
                        @endif
                        <h3>{{ $skate->brand }} {{ $skate->model }}</h3>
                        <p class="size">Размер: {{ $skate->size }}</p>
                        <p class="quantity">В наличии: {{ $skate->quantity }}</p>
                        <p class="description">{{ $skate->description }}</p>
                    </div>
                @empty
                    <p class="no-skates">Коньки временно отсутствуют</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title">О нас</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>IceArena - это современный ледовый каток с профессиональным покрытием и комфортными условиями для катания. Мы предлагаем:</p>
                    <ul>
                        <li>Качественный лед</li>
                        <li>Удобные раздевалки</li>
                        <li>Кафе с горячими напитками</li>
                        <li>Профессиональные коньки в аренду</li>
                        <li>Инструкторы для начинающих</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacts Section -->
    <section id="contacts" class="contacts">
        <div class="container">
            <h2 class="section-title">Контакты</h2>
            <div class="contacts-grid">
                <div class="contact-info">
                    <h3>Адрес</h3>
                    <p>ул. Ледовая, 1</p>
                    <h3>Телефон</h3>
                    <p>+7 (999) 123-45-67</p>
                    <h3>Email</h3>
                    <p>info@icearena.ru</p>
                </div>
                <div class="working-hours">
                    <h3>Режим работы</h3>
                    <p>Пн-Пт: 10:00 - 22:00</p>
                    <p>Сб-Вс: 09:00 - 23:00</p>
                </div>
            </div>
        </div>
    </section>
@endsection