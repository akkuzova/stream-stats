@extends('dashboard.header')
@section('content')
    <h1>Hello, {{$user->username}}</h1>
    <table>
        <caption>Short statistic</caption>
        <tr>
            <th>
                Median number of viewers for all streams
            </th>
            <td>
                100
            </td>
        </tr>
        <tr>
            <th>
                Total number of streams by their start time (rounded to the nearest hour)
            </th>
            <td>


            </td>
        </tr>
        <tr>
            <th>
                Which tags are shared between the user followed streams and the top 1000 streams? Also make sure to
                translate the tags to their respective name?

            </th>
            <td>

            </td>
        </tr>
    </table>
@endsection
