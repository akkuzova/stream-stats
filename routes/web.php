<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('dashboard/top_streams_by_viewer');
});

Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::prefix('twitch')->group(
    function () {
        Route::get('redirect', [AuthController::class, 'redirect'])->name('twitch.redirect');
        Route::get('callback', [AuthController::class, 'callback'])->name('twitch.callback');
    }
);

Route::middleware(['auth'])->group(
    function () {
        Route::prefix('dashboard')->group(
            function () {
                Route::get('personal_stats', [DashboardController::class, 'getPersonalStats'])
                    ->name('personal_stats');
            });
    }
);

Route::prefix('dashboard')->group(
    function () {
        Route::get('streams_by_game', [DashboardController::class, 'getStreamCountByGame'])
            ->name('streams_by_game');
        Route::get('games_by_viewer', [DashboardController::class, 'getTopGamesByViewerCount'])
            ->name('games_by_viewer');
        Route::get('top_streams_by_viewer', [DashboardController::class, 'getTop100StreamsByViewerCount'])
            ->name('top_streams_by_viewer');
        Route::get('top_streams_by_start_time', [DashboardController::class, 'getStreamsByStartTime'])
            ->name('top_streams_by_start_time');
    });
