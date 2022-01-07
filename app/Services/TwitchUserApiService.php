<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TwitchUserApiService
{
    private const BASE_URL = 'https://api.twitch.tv/helix/';

    protected function getPendingRequest(): PendingRequest
    {
        $token = Auth::user()->twitch_token;
        return Http::withHeaders(['Authorization' => "Bearer {$token}", 'Client-Id' => env('TWITCH_CLIENT_ID')]);
    }

    public function getFollowedStreams(): array
    {
        $response = $this->getPendingRequest()
            ->get(self::BASE_URL . 'streams/followed', ['user_id' => Auth::user()->twitch_id]);

        return $response->json('data');
    }

    public function getTagNamesForStream($broadcasterId): array
    {
        $response = $this->getPendingRequest()
            ->get(self::BASE_URL . 'streams/tags', ['broadcaster_id' => $broadcasterId])
            ->json('data');

        $tags = [];
        foreach ($response as $item) {
            $id = $item['tag_id'];
            $tags[$id] = $item['localization_names']['en-us'];
        }

        return $tags;
    }
}
