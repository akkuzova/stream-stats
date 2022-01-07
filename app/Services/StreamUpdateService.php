<?php

namespace App\Services;

use App\Models\Stream;

class StreamUpdateService
{
    protected TwitchAppApiService $apiService;

    public const OFFSET = 100;
    public const COUNT = 1000;

    protected array $streams = [];

    public function __construct(TwitchAppApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function update()
    {
        [$items, $cursor] = $this->apiService->getTopStreams(self::OFFSET);
        $this->appendStreams($items);
        while (count($this->streams) < self::COUNT) {
            [$items, $cursor] = $this->apiService->getTopStreams(self::OFFSET, $cursor);
            $this->appendStreams($items);
        }
        echo count($this->streams) . PHP_EOL;

        if (count($this->streams) > self::COUNT) {
            $this->streams = array_slice($this->streams, 0, self::COUNT);
        }
        echo count($this->streams) . PHP_EOL;

        shuffle($this->streams);

        foreach ($this->streams as $stream) {
            echo json_encode($stream) . PHP_EOL;
        }

        Stream::truncateAndInsert($this->streams);
    }

    protected function appendStreams(array $items)
    {
        foreach ($items as $item) {
            $this->streams[] = [
                'channel_name' => $item['user_name'],
                'stream_title' => $item['title'],
                'game_name' => $item['game_name'],
                'viewer_count' => $item['viewer_count'],
                'started_at' => date_create($item['started_at']),
                'tags' => json_encode($item['tag_ids']),
                'twitch_id' =>  $item['id'],
            ];
        }
    }
}
