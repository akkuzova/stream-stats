@php use Illuminate\Support\Facades\Auth; @endphp
<div class="nav-container">
    <nav>
        <a href="{{ route('top_streams_by_viewer') }}"
           class="{{ Route::currentRouteName() === 'top_streams_by_viewer' ? 'active' : '' }}">Top 100 Streams</a>
        <a href="{{ route('streams_by_game') }}"
           class="{{ Route::currentRouteName() === 'streams_by_game' ? 'active' : '' }}">Streams by game</a>
        <a href="{{ route('games_by_viewer') }}"
           class="{{ Route::currentRouteName() === 'games_by_viewer' ? 'active' : '' }}">Games by viewers</a>
        <a href="{{ route('top_streams_by_start_time') }}"
           class="{{ Route::currentRouteName() === 'top_streams_by_start_time' ? 'active' : '' }}">Streams by start
            time</a>
        <a href="{{ route('personal_stats') }}"
           class="{{ Route::currentRouteName() === 'personal_stats' ? 'active' : '' }}">Personal Statistics</a>
    </nav>

    <div class="animation start-home"></div>
    <div class="auth-buttons">
        @if(Auth::hasUser())
            <button class="btn btn-twitch logout" onclick="window.location='{{route ('logout') }}'">Log out</button>
        @else
            <button type="button" class="btn btn-twitch" onclick="window.location='{{route ('twitch.redirect') }}'">
                Log In
                <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 2400 2800"
                     xml:space="preserve">
                <g>
                    <polygon class="st0"
                             points="2200,1300 1800,1700 1400,1700 1050,2050 1050,1700 600,1700 600,200 2200,200 	"/>
                    <g>
                        <g id="Layer_1-2">
                            <path class="st1" d="M500,0L0,500v1800h600v500l500-500h400l900-900V0H500z M2200,1300l-400,400h-400l-350,350v-350H600V200h1600
				V1300z"/>
                            <rect x="1700" y="550" class="st1" width="200" height="600"/>
                            <rect x="1150" y="550" class="st1" width="200" height="600"/>
                        </g>
                    </g>
                </g>
            </svg>
            </button>
        @endif
    </div>
</div>
