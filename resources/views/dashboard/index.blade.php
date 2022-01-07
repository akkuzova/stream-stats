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
                {{$median}}
            </td>
        </tr>
        <tr>
            <th>
                The lowest viewer count stream you are following
            </th>
            <td>
                {{$lowestStream}}
            </td>
        </tr>
        <tr>
            <th>
                The number of viewers {{$lowestStream}} need to gain in order to make it into the top 1000
            </th>
            <td>
                {{$number}}
            </td>
        </tr>
        <tr>
            <th>
                Tags you are shared with the top 1000 streams ({{count($tags)}})
            </th>
            <td>
                {{ implode(', ', $tags) }}
            </td>
        </tr>
        <tr>
            <th>
                Streams you are following from the top 1000 streams ({{count($streams)}})
            </th>
            <td>
                {!!implode('<br/>', $streams)!!}
            </td>
        </tr>
    </table>
@endsection
