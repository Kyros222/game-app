@extends('layouts.main')
@section('content')
    <div class="feedback">
        <div class="container">
            <h2>
                Авторизация
            </h2>
            <p>Войдите в свой Аккаунт</p>

            <form method="post" action="{{ route('auth.submit') }}">
                @csrf
                <div class="inline">
                    <div>
                        <label>Логин</label>
                        <input type="text" name="login" value="{{ old('login') }}" id="login">
                        @error('login')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label>Пароль</label>
                        <input type="password" class="one-line" name="password">
                        @error('password')
                            <div class="error-message">Пароль должен быть больше 8 символов.</div>
                        @enderror
                    </div>
                </div>
                <button type="submit">Авторизоваться</button>
                @if (session('error'))
                    <div class="error-message">
                        {{ session('error') }}
                    </div>
                @endif

            </form>
        </div>
    </div>
    </div>
@endsection
