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
</div>
