<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class TwitchApiService
{
    protected ?string $token = null;
    protected const TWITCH_AUTH_URL = 'https://id.twitch.tv/oauth2/token';

    protected function getAppToken(): string
    {
        if (!$this->token) {
            $response = Http::post(self::TWITCH_AUTH_URL,
                [
                    'client_id' => env('TWITCH_CLIENT_ID'),
                    'client_secret' => env('TWITCH_CLIENT_SECRET'),
                    'grant_type' => 'client_credentials',
                ]
            );

            $this->token = $response->json('access_token');
        }

        return $this->token;
    }

    protected function getPendingRequest(): PendingRequest
    {
      //  $token = $this->getAppToken();
        $token = "0x0q083rs10tyf4nldjwhy6oqsun3v";
        var_dump($token);
        return Http::withHeaders(['Authorization' => "Bearer {$token}", 'Client-Id' => env('TWITCH_CLIENT_ID')]);
    }

    public function getTopStreams(int $first, string $after = null): array
    {
        $response = $this->getPendingRequest()
            ->get('https://api.twitch.tv/helix/streams', ['first' => $first, 'after' => $after]);

        return [$response->json('data'), $response->json('pagination.cursor')];
    }
}
