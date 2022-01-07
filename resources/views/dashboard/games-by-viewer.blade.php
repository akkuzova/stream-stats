@extends('dashboard.header')
@section('content')
    <table>
        <caption>Top games by viewer count for each game</caption>
        <tr>
            <th>Game</th>
            <th>Number of viewers</th>
        </tr>
        @foreach($games as $game)
            <tr>
                <td>{{$game['game_name']}}</td>
                <td>{{$game['viewer_count']}}</td>
            </tr>
        @endforeach
    </table>
@endsection
