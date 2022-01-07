<?php

namespace App\Services;

use App\Models\Stream;

class UserStatsService
{
    protected TwitchUserApiService $apiService;

    public function __construct(TwitchUserApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getLowestViewersStreamFromFollowing(): array
    {
        $streams = $this->apiService->getFollowedStreams();
        usort($streams, function ($a, $b) {
            return $a['viewer_count'] <=> $b['viewer_count'];
        });

        return head($streams) ?: [];
    }

    public function getFollowingWithTopStreamsIntersection(): array
    {
        $followedStreams = $this->apiService->getFollowedStreams();
        $allStreams = Stream::all()->keyBy('twitch_id')->toArray();

        $intersection = [];
        foreach ($followedStreams as $stream) {
            $id = $stream['id'];
            if (isset($allStreams[$id])) {
                $intersection[$id] = $allStreams[$id]['stream_title'];
            }
        }

        return $intersection;
    }

    public function getFollowingWithTopTagsIntersection(): array
    {
        $followedTags = $this->getFollowedTagsNames();
        $allStreams = Stream::getAllStreamTags();
        $intersection = [];

        foreach ($allStreams as $stream) {
            $tags = json_decode($stream['tags']);
            foreach ($tags as $tag) {
                if (isset($followedTags[$tag])) {
                    $intersection[$tag] = $followedTags[$tag];
                }
            }
        }

        return $intersection;
    }

    public function getFollowedTagsNames(): array
    {
        $streams = $this->apiService->getFollowedStreams();
        $tags = [];

        foreach ($streams as $stream) {
            $broadcasterId = $stream['user_id'];
            $broadcasterTags = $this->apiService->getTagNamesForStream($broadcasterId);
            foreach ($broadcasterTags as $key => $value) {
                $tags[$key] = $value;
            }
        }
        return $tags;
    }
}
