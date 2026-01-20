@extends('layouts.main')
@section('content')
    <div class="container trending">
        <a href="#" class="see-all">SEE ALL</a>
        <h3>Currentle trending Games</h3>

        <div class="games">
            @foreach ($trends as $game)
                <div class="block">
                    <img src={{ $game->image }} alt="">
                    <span>
                        <img src="image/followers.png" alt="">
                        {{ $game->followers }} Followers
                    </span>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
