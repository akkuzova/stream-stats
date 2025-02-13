<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>StreamStats</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <div>
            <x-navigation activeLink="top_streams_by_viewer"/>
        </div>
        <div style="padding:50px;">
            @yield('content')
        </div>
    </body>
</html>
