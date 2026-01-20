@vite(['resources/css/style.css'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/3DD.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
    <title>3D game Dev</title>
</head>

<body>
    <div class="wrapper">
        <header class="container">
            <span class="logo">
                <div class="loader">
                    <div class="loader-cube">
                        <div class="face"></div>
                        <div class="face"></div>
                        <div class="face"></div>
                        <div class="face"></div>
                        <div class="face"></div>
                        <div class="face"></div>
                    </div>
                </div>
            </span>
            <nav>
                <ul>
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="/">Главная</a>
                    </li>
                    <li class="{{ request()->is('about') ? 'active' : '' }}">
                        <a href="{{ route('about') }}">Про Нас</a>
                    </li>
                    @if (Auth::check())
                        <li class="{{ request()->is('user') ? 'active' : '' }}">
                            <a href="{{ route('user') }}">Кабинет Пользователя</a>
                        </li>
                    @else
                        <li class="{{ request()->is('registration') ? 'active' : '' }}">
                            <a href="{{ route('registration.form') }}">Регистрация</a>
                        </li>
                        <li class="{{ request()->is('auth') ? 'active' : '' }}">
                            <a href="{{ route('auth.form') }}">Авторизация</a>
                        </li>
                    @endif
                    <li class='btn'>
                        <a href="{{ route('contact') }}">Contacts</a>
                    </li>

                </ul>
            </nav>
        </header>
        @yield('content')
        <footer>
            <div class="blocks container">
                <div>
                    <span class="logo">logo</span>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, beatae harum repellendus odit est
                        vero
                        molestias totam pariatur nobis quo!</p>
                </div>
                <div>
                    <h4>About Us</h4>
                    <ul>
                        <li>Zux</li>
                        <li>Gasdas</li>
                        <li>Zeux</li>
                        <li>Contacr Us</li>
                    </ul>
                </div>
                <div>
                    <h4>Contact Us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores asperiores accusamus recusandae
                        commodi eveniet?</p>
                    <p>+909 909 123 909</p>
                </div>
            </div>
            <hr>
            <p>Copyright @ 2025 KYRO <br> All rights recerved</p>
        </footer>

</body>

</html>
