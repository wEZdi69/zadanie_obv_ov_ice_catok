@extends('layouts.app')

@section('title', 'Покупка билета')

@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <h1>Покупка входного билета</h1>
                
                <form action="{{ route('ticket.store') }}" method="POST" class="ticket-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="full_name">ФИО *</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
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

                    <div class="form-info">
                        <p>Стоимость входа: 300₽</p>
                        <p class="total">Итого: 300₽</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">Перейти к оплате</button>
                </form>
            </div>
        </div>
    </section>
@endsection