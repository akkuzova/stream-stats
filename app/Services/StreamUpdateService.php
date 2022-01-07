<?php

namespace App\Services;

use App\Models\Stream;
use Illuminate\Support\Facades\Log;

class StreamUpdateService
{
    protected TwitchAppApiService $apiService;

    public const COUNT = 1000;

    public function __construct(TwitchAppApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function update()
    {
        $streams = $this->apiService->getTopStreams(self::COUNT);
        Log::info(count($streams) . ' streams retrieved');

        if (count($streams) > self::COUNT) {
            $streams = array_slice($streams, 0, self::COUNT);
        }

        shuffle($streams);

        Stream::truncateAndInsert($streams);
        Log::info(count($streams) . ' streams inserted');
    }
}
