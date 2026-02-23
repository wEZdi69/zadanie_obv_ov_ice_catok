<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ледовый каток')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="/" class="logo">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>IceArena</span>
                </a>

                <ul class="nav-menu">
                    <li><a href="/#about">О нас</a></li>
                    <li><a href="/#prices">Цены</a></li>
                    <li><a href="/#skates">Коньки</a></li>
                    <li><a href="/#contacts">Контакты</a></li>
                </ul>

                <div class="nav-buttons">
                    <a href="{{ route('ticket.form') }}" class="btn btn-primary">Купить билет</a>
                    <a href="{{ route('booking.form') }}" class="btn btn-secondary">Забронировать коньки</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3>IceArena</h3>
                    <p>Лучший ледовый каток в городе</p>
                </div>
                <div class="footer-contacts">
                    <h4>Контакты</h4>
                    <p>+7 (999) 123-45-67</p>
                    <p>info@icearena.ru</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 IceArena. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>