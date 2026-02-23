@extends('layouts.admin')

@section('title', 'Добавление коньков')
@section('header', 'Добавить коньки')

@section('content')
    <form action="{{ route('admin.skates.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        
        <div class="form-group">
            <label for="brand">Бренд *</label>
            <input type="text" id="brand" name="brand" value="{{ old('brand') }}" required>
            @error('brand')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="model">Модель *</label>
            <input type="text" id="model" name="model" value="{{ old('model') }}" required>
            @error('model')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="size">Размер *</label>
            <input type="number" id="size" name="size" min="30" max="47" value="{{ old('size') }}" required>
            @error('size')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Количество *</label>
            <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity') }}" required>
            @error('quantity')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" id="image" name="image" accept="image/*">
            @error('image')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.skates.index') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
@endsection
