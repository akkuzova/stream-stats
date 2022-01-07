<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class TwitchAppApiService
{
    protected ?string $token = null;
    protected const TWITCH_AUTH_URL = 'https://id.twitch.tv/oauth2/token';
    protected const BASE_URL = 'https://api.twitch.tv/helix/';

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
        $token = $this->getAppToken();
        return Http::withHeaders(['Authorization' => "Bearer {$token}", 'Client-Id' => env('TWITCH_CLIENT_ID')]);
    }

    public function getTopStreams(int $first, string $after = null): array
    {
        $response = $this->getPendingRequest()
            ->get(self::BASE_URL . 'streams', ['first' => $first, 'after' => $after]);

        return [$response->json('data'), $response->json('pagination.cursor')];
    }
}
