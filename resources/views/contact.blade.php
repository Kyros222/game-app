@extends('layouts.main')
@section('content')
    <div class="container hero-contacts">
        <h1>Lorem ipsum, dolor sit amet consectetur adipisicing.</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet similique aliquid est nemo tenetur!
            Velit minima recusandae libero quod rerum saepe asperiores. Cum itaque doloremque, nulla molestias
            soluta suscipit sequi?</p>
        <img src="/image/map.png" alt="">
    </div>

    <div class="feedback">
        <div class="container">
            <h2>
                Say Hello!
            </h2>
            <p>Lorem ipsum dolor sit amet consectetur.</p>

            <form>
                <div class="inline">
                    <div>
                        <label> First Name</label>
                        <input type="text">
                    </div>
                    <div>
                        <label> Last Name</label>
                        <input type="text">
                    </div>
                </div>
                <label>Email Adress</label>
                <input type="email" class="one-line">
                <label>Message</label>
                <textarea class="one-line"></textarea>

                <button type="button">Get in touch</button>
            </form>
        </div>
    </div>
    </div>
@endsection
