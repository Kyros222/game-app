@extends('layouts.main')
@section('content')
    <div class="exit container">
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    </div>
    <div class="feedback">
        <div class="container">
            <h2>
                Кабинет пользователя
            </h2>
            <p>Привет: <b>{{ Auth::user()->name }}</b> </p>

            <form method="post" action="create">
                @csrf
                <label>Изображение</label>
                <input type="text" class="one-line" name="image" value="{{ old('image') }}">
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <label>Подписчики</label>
                <input type="text" class="one-line" name="followers" value="{{ old('followers') }}">
                @error('followers')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <button type="submit">Добавить</button>

            </form>
        </div>
    </div>
    </div>
@endsection
