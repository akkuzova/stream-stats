<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('login');
});

Route::prefix('twitch')->group(
    function () {
        Route::get('redirect', [AuthController::class, 'redirect'])->name('twitch.redirect');
        Route::get('callback', [AuthController::class, 'callback'])->name('twitch.callback');
    }
);
