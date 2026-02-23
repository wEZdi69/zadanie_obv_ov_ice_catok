@extends('layouts.admin')

@section('title', 'Дашборд')
@section('header', 'Дашборд')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Всего коньков</h3>
            <p class="stat-number">{{ $stats['total_skates'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Всего бронирований</h3>
            <p class="stat-number">{{ $stats['total_bookings'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Оплаченных бронирований</h3>
            <p class="stat-number">{{ $stats['paid_bookings'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Проданных билетов</h3>
            <p class="stat-number">{{ $stats['total_tickets'] }}</p>
        </div>
    </div>

    <div class="recent-grid">
        <div class="recent-block">
            <h2>Последние бронирования</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_bookings'] as $booking)
                        <tr>
                            <td>{{ $booking->full_name }}</td>
                            <td>{{ $booking->phone }}</td>
                            <td>{{ $booking->total_amount }}₽</td>
                            <td>
                                @if($booking->is_paid)
                                    <span class="badge badge-success">Оплачено</span>
                                @else
                                    <span class="badge badge-warning">Ожидает</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="recent-block">
            <h2>Последние билеты</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_tickets'] as $ticket)
                        <tr>
                            <td>{{ $ticket->full_name }}</td>
                            <td>{{ $ticket->email }}</td>
                            <td>{{ $ticket->phone }}</td>
                            <td>
                                @if($ticket->is_paid)
                                    <span class="badge badge-success">Оплачено</span>
                                @else
                                    <span class="badge badge-warning">Ожидает</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection