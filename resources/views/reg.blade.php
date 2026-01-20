@extends('layouts.main')
@section('content')
    <div class="feedback">
        <div class="container">
            <h2>
                Registration
            </h2>
            <p>Давайте мы с вами познакомимся!</p>

            <form action="{{ route('registration.submit') }}" method="post">
                @csrf
                <div class="inline">
                    <div>
                        <label>Логин</label>
                        <input type="text" name="login" id="login" placeholder="Введите логин"
                            value="{{ old('login') }}">
                        @error('login')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label>Имя</label>
                        <input type="text" name="name" id="name" placeholder="Введите своё имя"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <label>Email</label>
                <input type="email" class="one-line" name="email" id="email" placeholder="Введите email"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <label>Пароль</label>
                <input type="password" class="one-line" name="password" id="password" placeholder="Введите пароль">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
