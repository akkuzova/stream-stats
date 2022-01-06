<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('home');
});

Route::prefix('twitch')->group(
    function () {
        Route::get('redirect', [AuthController::class, 'redirect'])->name('twitch.redirect');
        Route::get('callback', [AuthController::class, 'callback'])->name('twitch.callback');
    }
);

Route::middleware(['auth'])->group(
    function () {
        Route::get('home', [DashboardController::class, 'index'])
            ->name('home');
        Route::prefix('dashboard')->group(
            function () {
                Route::get('streams_by_game', [DashboardController::class, 'getStreamCountByGame'])
                    ->name('streams_by_game');
                Route::get('games_by_viewer', [DashboardController::class, 'getTopGamesByViewerCount'])
                    ->name('games_by_viewer');
                Route::get('top_streams_by_viewer', [DashboardController::class, 'getTop100StreamsByViewerCount'])
                    ->name('top_streams_by_viewer');
            });
    }
);
