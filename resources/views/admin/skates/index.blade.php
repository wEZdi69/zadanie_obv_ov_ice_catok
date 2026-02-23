@extends('layouts.admin')

@section('title', 'Управление коньками')
@section('header', 'Коньки')

@section('content')
    <div class="action-bar">
        <a href="{{ route('admin.skates.create') }}" class="btn btn-primary">Добавить коньки</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Изображение</th>
                <th>Модель</th>
                <th>Бренд</th>
                <th>Размер</th>
                <th>Количество</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skates as $skate)
                <tr>
                    <td>{{ $skate->id }}</td>
                    <td>
                        @if($skate->image)
                            <img src="{{ asset('storage/' . $skate->image) }}" alt="{{ $skate->model }}" width="50">
                        @endif
                    </td>
                    <td>{{ $skate->model }}</td>
                    <td>{{ $skate->brand }}</td>
                    <td>{{ $skate->size }}</td>
                    <td>{{ $skate->quantity }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.skates.edit', $skate) }}" class="btn btn-sm btn-secondary">Редактировать</a>
                        <form action="{{ route('admin.skates.destroy', $skate) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $skates->links() }}
    </div>
@endsection