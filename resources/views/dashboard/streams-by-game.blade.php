@extends('main')
@section('content')
    <table>
        <caption>Total number of streams for each game</caption>
        <tr>
            <th>Game</th>
            <th>Number of streams</th>
        </tr>
        @foreach($games as $game)
            <tr>
                <td>{{$game['game_name']}}</td>
                <td>{{$game['stream_count']}}</td>
            </tr>
        @endforeach
    </table>
@endsection
