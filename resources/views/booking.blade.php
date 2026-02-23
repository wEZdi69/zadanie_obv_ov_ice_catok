@extends('layouts.app')

@section('title', 'Бронирование коньков')

@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <h1>Бронирование коньков</h1>
                
                <form action="{{ route('booking.store') }}" method="POST" class="booking-form" id="bookingForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="full_name">ФИО *</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Телефон *</label>
                        <input type="tel" id="phone" name="phone" class="phone-mask" placeholder="+7 (___) ___-__-__" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hours">Количество часов аренды *</label>
                        <select id="hours" name="hours" required>
                            <option value="1" {{ old('hours') == 1 ? 'selected' : '' }}>1 час</option>
                            <option value="2" {{ old('hours') == 2 ? 'selected' : '' }}>2 часа</option>
                            <option value="3" {{ old('hours') == 3 ? 'selected' : '' }}>3 часа</option>
                            <option value="4" {{ old('hours') == 4 ? 'selected' : '' }}>4 часа</option>
                        </select>
                        @error('hours')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group checkbox-group">
                        <label>
                            <input type="checkbox" name="has_skates" id="hasSkates" value="1" {{ old('has_skates') ? 'checked' : '' }}>
                            Мне нужны коньки (150₽/час)
                        </label>
                    </div>

                    <div id="skatesSection" style="{{ old('has_skates') ? 'display: block;' : 'display: none;' }}">
                        <div class="form-group">
                            <label for="skate_id">Выберите модель коньков</label>
                            <select id="skate_id" name="skate_id">
                                <option value="">Выберите модель</option>
                                @foreach($skates as $skate)
                                    <option value="{{ $skate->id }}" {{ old('skate_id') == $skate->id ? 'selected' : '' }}>
                                        {{ $skate->brand }} {{ $skate->model }} (размер {{ $skate->size }})
                                    </option>
                                @endforeach
                            </select>
                            @error('skate_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="skate_size">Ваш размер обуви</label>
                            <input type="number" id="skate_size" name="skate_size" min="30" max="47" value="{{ old('skate_size') }}">
                            @error('skate_size')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-info" id="totalPrice">
                        <p>Стоимость входа: 300₽</p>
                        <p>Аренда коньков: 0₽</p>
                        <p class="total">Итого: 300₽</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">Перейти к оплате</button>
                </form>
            </div>
        </div>
    </section>
@endsection