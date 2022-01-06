@extends('main')
@section('menu')
    <nav>
        <a href={{route ('streams_by_game') }}>Streams by game</a>
        <a href={{route ('games_by_viewer') }}>Games by viewers</a>
        <a href={{route ('top_streams_by_viewer') }}>Top 100 Streams by viewers</a>
        <a href={{route ('home') }}>Home</a>
        <a href="#">Contact</a>
        <div class="animation start-home"></div>
    </nav>
@endsection
