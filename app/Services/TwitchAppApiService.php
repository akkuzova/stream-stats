<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class TwitchAppApiService
{
    public const LIMIT = 100;
    protected const TWITCH_AUTH_URL = 'https://id.twitch.tv/oauth2/token';
    protected const BASE_URL = 'https://api.twitch.tv/helix/';
    protected ?string $token = null;
    protected array $streams = [];

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

    public function getStreamsChunk(int $first, string $after = null): array
    {
        $response = $this->getPendingRequest()
            ->get(self::BASE_URL . 'streams', ['first' => $first, 'after' => $after]);

        return [$response->json('data'), $response->json('pagination.cursor')];
    }

    public function getTopStreams($count): array
    {
        [$items, $cursor] = $this->getStreamsChunk(self::LIMIT);
        $this->appendStreams($items);
        while (count($this->streams) < $count) {
            [$items, $cursor] = $this->getStreamsChunk(self::LIMIT, $cursor);
            $this->appendStreams($items);
        }
        return $this->streams;
    }

    protected function appendStreams(array $items)
    {
        foreach ($items as $item) {
            $this->streams[$item['id']] = [
                'channel_name' => $item['user_name'],
                'stream_title' => $item['title'],
                'game_name' => $item['game_name'],
                'viewer_count' => $item['viewer_count'],
                'started_at' => date_create($item['started_at']),
                'tags' => json_encode($item['tag_ids']),
                'twitch_id' => $item['id'],
            ];
        }
    }
}
