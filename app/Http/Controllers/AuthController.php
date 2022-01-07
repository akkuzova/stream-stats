<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(): View
    {
        return view('login');
    }

    public function redirect(): RedirectResponse
    {
        return Socialite::driver('twitch')
            ->scopes(['user:read:follows'])
            ->redirect();
    }

    public function callback(): RedirectResponse
    {
        $twitchUser = Socialite::driver('twitch')->user();
        $user = User::findOneByTwitchUserId($twitchUser->getId());
        if ($user) {
            $user->update([
                'twitch_token' => $twitchUser->token,
                'twitch_refresh_token' => $twitchUser->refreshToken,
            ]);
        } else {
            $user = User::create([
                'username' => $twitchUser->name,
                'email' => $twitchUser->email,
                'twitch_id' => $twitchUser->id,
                'twitch_token' => $twitchUser->token,
                'twitch_refresh_token' => $twitchUser->refreshToken,
            ]);
        }

        Auth::login($user);
        return redirect('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
