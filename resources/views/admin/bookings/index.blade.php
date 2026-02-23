@extends('layouts.admin')

@section('title', 'Бронирования')
@section('header', 'Бронирования')

@section('content')
    <div class="filters">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="filter-form">
            <div class="form-group">
                <input type="text" name="search" placeholder="Поиск по имени или телефону" value="{{ request('search') }}">
            </div>
            <div class="form-group">
                <select name="status">
                    <option value="">Все статусы</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Оплачено</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Ожидает</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Фильтр</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Часов</th>
                <th>Коньки</th>
                <th>Сумма</th>
                <th>Статус</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->full_name }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->hours }}</td>
                    <td>
                        @if($booking->has_skates)
                            {{ $booking->skate->brand ?? '' }} {{ $booking->skate->model ?? '' }} (р-р {{ $booking->skate_size }})
                        @else
                            Свои
                        @endif
                    </td>
                    <td>{{ $booking->total_amount }}₽</td>
                    <td>
                        @if($booking->is_paid)
                            <span class="badge badge-success">Оплачено</span>
                        @else
                            <span class="badge badge-warning">Ожидает</span>
                        @endif
                    </td>
                    <td>{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-secondary">Просмотр</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $bookings->links() }}
    </div>
@endsection