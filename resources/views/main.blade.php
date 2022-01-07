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

        .logout {
            position: absolute;
            display: inline-block;
            margin: 0 auto;
            padding: 3px;
            right: 50px;
            top: 35px;
        }

        .div-twitch {
            position: relative;
        }

        .btn-twitch:hover,
        .btn-twitch:focus,
        .btn-twitch:active {
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

        nav {
            margin: 27px auto 0;
            position: relative;
            width: 1000px;
            height: 70px;
            background-color: #D2D2E6;
            border-radius: 8px;
            font-size: 0;
        }

        nav a {
            line-height: 50px;
            height: 100%;
            font-size: 10px;
            display: inline-block;
            position: relative;
            z-index: 1;
            text-decoration: none;
            text-transform: uppercase;
            text-align: center;
            color: black;
            cursor: pointer;
            width: 150px;
        }

        nav .animation {
            position: absolute;
            height: 100%;
            top: 0;
            z-index: 0;
            transition: all .5s ease 0s;
            border-radius: 8px;
        }

        nav a:hover ~ .animation {
            width: 150px;
            background-color: #BFABFF;
        }

        nav a:nth-child(1):hover ~ .animation {
            left: 0;
        }

        nav a:nth-child(2):hover ~ .animation {
            left: 150px;
        }

        nav a:nth-child(3):hover ~ .animation {
            left: 300px;
        }

        nav a:nth-child(4):hover ~ .animation {
            left: 450px;
        }

        nav a:nth-child(5):hover ~ .animation {
            left: 600px;
        }

        h1 {
            text-align: center;
            margin: 40px 0 40px;
            font-size: 30px;
            color: black;
        }

        span {
            color: #BFABFF;
        }

        table {
            margin: 0 auto;
            color: #333;
            background: white;
            border: 1px #9146FF;
            font-size: 12pt;
            border-collapse: collapse;
        }

        table thead th,
        table tfoot th {
            color: #BFABFF;
            background: #472e75;
        }

        table caption {
            padding: .5em;
            font-size: 14pt;
        }

        table th,
        table td {
            padding: .5em;
            border: 1px solid #D2D2E6;
        }
    </style>
    <div>
        @if(\Illuminate\Support\Facades\Auth::hasUser())
            <button class="btn btn-twitch logout" onclick="window.location='{{route ('logout') }}'">Log out</button>
        @endif
        @yield('menu')
    </div>
</head>
<body>
<div style="padding:50px;">
    @yield('content')
</div>
</body>
</html>
