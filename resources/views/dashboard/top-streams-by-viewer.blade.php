@extends('dashboard.header')
@section('content')
    <table>
        <caption>List of top 100 streams by viewer count that can be sorted asc & desc</caption>
        <div style="display: inline-block; position: absolute">
            <div style="display: inline-block">
                <input type="radio" id="asc" name="orderBy" value="asc"
                       {{($orderBy == 'asc') ? "checked" : ""}}
                       onclick="window.location='{{route('top_streams_by_viewer', ['order_by' => 'asc'])}}'">
                <label for="asc">ASC</label>
            </div>
            <div style="display: inline-block">
                <input type="radio" id="desc" name="orderBy" value="desc"
                       {{($orderBy == 'desc') ? "checked" : ""}}
                       onclick="window.location='{{route('top_streams_by_viewer', ['order_by' => 'desc'])}}'">
                <label for="desc">DESC</label>
            </div>
        </div>
        <tr>
            <th>Stream</th>
            <th>Number of viewers</th>
        </tr>
        @foreach($streams as $stream)
            <tr>
                <td>{{$stream['stream_title']}}</td>
                <td>{{$stream['viewers_number']}}</td>
            </tr>
        @endforeach
    </table>
@endsection
