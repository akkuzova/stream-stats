@extends('main')
@section('menu')
    <nav>
        <a href={{route ('home') }}>Home</a>
        <a href={{route ('streams_by_game') }}>Streams by game</a>
        <a href={{route ('games_by_viewer') }}>Games by viewers</a>
        <a href={{route ('top_streams_by_viewer') }}>Top 100 Streams</a>
        <a href="{{route ('top_streams_by_start_time') }}">Streams by start time </a>
        <div class="animation start-home"></div>
    </nav>
@endsection
