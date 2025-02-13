@extends('main')
@section('content')
    <table>
        <caption>Total number of streams by their start time</caption>
        <tr>
            <th>Start time</th>
            <th>Total number of streams</th>
        </tr>
        @foreach($streams as $key => $value)
            <tr>
                <td>{{date("Y-m-d H:i:s", $key)}}</td>
                <td>{{count($value)}}</td>
            </tr>
        @endforeach
    </table>
@endsection
