@extends('layouts.main')
@section('content')
    <div class="hero container">


        <div class="hero--info">
            <h2>3D game Dev</h2>
            <h1>Работа для наших клиентов.</h1>
            <p>Работа в 3D Game Dev — это сочетание творчества, технологий и командной работы.

                Если хочешь попасть в 3D Game Dev — пробуй делать простые проекты самостоятельно, выкладывай их в
                онлайн-портфолио и участвуй в гейм-джемах!

                Если интересует какая-то конкретная специальность, программа или путь в индустрию — спроси, расскажем
                подробнее.</p>
            <a class="btn" href="about">Узнать больше</a>
            <img src="image/jostik.png" alt="">
        </div>
    </div>

    <div class="container trending">
        <a href="trending" class="see-all">SEE ALL</a>
        <h3>Актуальные тренды</h3>

        <div class="games">
            <div class="games">
                @foreach ($trends as $game)
                    <div class="block">
                        <img src="{{ $game->image }}" alt="">
                        <span>
                            <img src="image/followers.png" alt="">
                            {{ $game->followers }} Followers
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container big-text">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, a necessitatibus. Perspiciatis.
    </div>

    <div class="container banner">
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem incidunt odit vitae ullam!</p>
        <img src="image/CoD MW2 15-Nov09-23.jpg" alt="">
    </div>
    </div>
    <div class="features">
        <div class="container">
            <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, repellat. Beatae, est?</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi, earum nam. Earum nemo magnam fuga
                saepe. Cupiditate alias dolor, reiciendis aspernatur earum quisquam?</p>
            <div class="info">
                <div class="block">
                    <img src="/image/mobile.svg" alt="">
                    <p>Mobile Game Development</p>
                    <img src="image/arrow-short-right-svgrepo-com.svg" alt="">
                </div>
                <div class="block">
                    <img src="/image/mobile.svg" alt="">
                    <p>Mobile Game Development</p>
                    <img src="image/arrow-short-right-svgrepo-com.svg" alt="">
                </div>
                <div class="block">
                    <img src="/image/mobile.svg" alt="">
                    <p>Mobile Game Development</p>
                    <img src="image/arrow-short-right-svgrepo-com.svg" alt="">
                </div>
                <div class="block">
                    <img src="/image/mobile.svg" alt="">
                    <p>Mobile Game Development</p>
                    <img src="image/arrow-short-right-svgrepo-com.svg" alt="">
                </div>
                <div class="block">
                    <img src="/image/mobile.svg" alt="">
                    <p>Mobile Game Development</p>
                    <img src="image/arrow-short-right-svgrepo-com.svg" alt="">
                </div>
                <div class="block">
                    <img src="/image/mobile.svg" alt="">
                    <p>Mobile Game Development</p>
                    <img src="image/arrow-short-right-svgrepo-com.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container projects">
            <h3>Our Recent Projects</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis qui minus neque illum quibusdam ea
                vitae tempora rem cumque eum.</p>
            <div class="images">
                <img src="/image/i (2).webp" alt="">
                <img src="/image/i (2).webp" alt="">
                <img src="/image/i (2).webp" alt="">
            </div>
            <div class="images">
                <img src="/image/i (2).webp" alt="">
                <img src="/image/i (2).webp" alt="">
                <img src="/image/i (2).webp" alt="">
            </div>
            <a href="#" class="see-all">SEE-ALL</a>

        </div>

        <div class="container email">
            <h3>Lorem, ipsum.</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates itaque fuga ratione reiciendis optio
                minima consectetur consequatur adipisci impedit earum.</p>
            <div class="block">
                <div>
                    <h4>Stay in the Loop</h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur tenetur debitis eligendi
                        corporis.</p>
                </div>
                <div>
                    <input id="emailField" placeholder="Enter E-mail adress">
                    <button onclick="checkEmail()">Continue</button>
                </div>
            </div>
        </div>


    </div>
@endsection
<script>
    function checkEmail() {
        let email = document.querySelector('#emailField').value;
        if (!email.includes('@')) alert('Нет символа: @');
        else if (!email.includes('.')) alert('Нет символа: .');
        else alert('Всё отлично!');
    }
</script>
