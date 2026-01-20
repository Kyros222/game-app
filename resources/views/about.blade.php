@vite(['resources/css/style.css', 'resources/js/carousel.js'])
@extends('layouts.main')
@section('content')
    <div class="hero-about container">
        <div class="info">
            <h1>Про нас</h1>
            <p>Наше сообщество объединяет разработчиков 3D‑игр, художников, сценаристов и всех, кто живёт идеей создавать
                собственные виртуальные миры. Мы делимся опытом, вдохновляем друг друга и вместе растём, превращая увлечение
                в профессию.</p>
            <br><br>

            <h1>Наша цель</h1>
            <p>поддерживать молодых талантов и помогать им делать первые шаги в индустрии. Здесь
                каждый может
                найти наставников, единомышленников и команду для своих проектов. Мы верим, что даже одна хорошая идея может
                стать началом великой игры.
            </p>
            <button class="btn">Get in touch</button>
        </div>
        <img src="/image/neon.png" alt="">
    </div>
    <h1 class="swiper-title">Почему именно мы?</h1>
    <div class="swiper-container">

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide item-1" data-index="1">
                    <div class="review-content">
                        <img src="https://i.pravatar.cc/100?img=4" alt="">
                        <p class="review-author">Иван Иванов</p>
                        <p class="review-text">Очень понравилось сообщество, атмосферно и удобно для развития!</p>
                    </div>
                </div>
                <div class="swiper-slide item-2" data-index="2">
                    <div class="review-content">
                        <img src="https://i.pravatar.cc/100?img=5" alt="avatar">
                        <p class="review-author">Екатерина Смирнова</p>
                        <p class="review-text">Нашла команду для первого проекта, спасибо организаторам!</p>
                    </div>
                </div>
                <div class="swiper-slide item-3" data-index="3">
                    <div class="review-content">
                        <img src="https://i.pravatar.cc/100?img=3 alt="avatar">
                        <p class="review-author">Максим Чернов</p>
                        <p class="review-text">Тут поддерживают даже новичков — сразу стало понятно, что я не один!</p>
                    </div>
                </div>
                <div class="swiper-slide item-4" data-index="4">
                    <div class="review-content">
                        <img src="https://i.pravatar.cc/100?img=1" alt="avatar">
                        <p class="review-author">Алёна Гладишева</p>
                        <p class="review-text">Очень тёплый коллектив и много полезных лекций и материалов.</p>
                    </div>
                </div>
                <div class="swiper-slide item-5" data-index="5">
                    <div class="review-content">
                        <img src="https://i.pravatar.cc/100?img=2" alt="avatar">
                        <p class="review-author">Дмитрий Шестаков</p>
                        <p class="review-text">Рад, что присоединился — атмосфера супер!</p>
                    </div>
                </div>
            </div>
            <div class="swiper-control"></div>
        </div>
    </div>


    <script src="carousel.js"></script>
@endsection
