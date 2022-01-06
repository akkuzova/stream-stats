<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StreamStats</title>

    <style>
        body {
            font-family: 'Helvetica', SemiBold, serif;
            background: #F0F0FF;
        }
        .btn-twitch {
            border-radius: 3px;
            color: #FFFFFF;
            background-color: #9146FF;
            border-color: #9146FF;
            height: 50px;
            width: 130px;
            font-weight: bold;
        }
        .logout{
            position: absolute;
            top: 50px;
            right: 50px;
        }
        .div-twitch {
            position: relative;
        }
        .btn-twitch:hover,
        .btn-twitch:focus,
        .btn-twitch:active,
        .btn-twitch.active,
        .open .dropdown-toggle.btn-twitch {
            color: #FFFFFF;
            background-color: #472e75;
            border-color: #2F1F4E;
        }
        svg {
            position: absolute;
            left: 5px;
            top: 10px;
            height: 40px;
            width: 40px;
        }
        .st0 {
            fill: #FFFFFF;
        }
        .st1 {
            fill: #9146FF;
        }
    </style>
    @if(\Illuminate\Support\Facades\Auth::hasUser())
        <button class="btn btn-twitch logout" onclick="window.location='{{route ('logout') }}'">Log out</button>
    @endif
    @yield('menu')
</head>
<body>
<div style="padding:50px;">
    @yield('content')
</div>
</body>
</html>
