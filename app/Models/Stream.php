<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stream extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_name',
        'stream_title',
        'game_name',
        'viewer_count',
        'started_at',
        'tags',
        'twitch_id',
    ];

    public static function truncateAndInsert(array $streams)
    {
        DB::transaction(function () use ($streams) {
            Stream::whereNotNull('id')->delete();
            Stream::insert($streams);
        });
    }

    public static function getStreamCountByGame(): array
    {
        return Stream::select('game_name', DB::raw('count(*) as stream_count'))
            ->groupBy(['game_name'])
            ->orderByDesc('stream_count')
            ->get()
            ->toArray();
    }

    public static function getTopGamesByViewerCount(): array
    {
        return Stream::select('game_name', DB::raw('sum(viewer_count) as viewer_count'))
            ->groupBy(['game_name'])
            ->orderByDesc('viewer_count')
            ->get()
            ->toArray();
    }

    public static function getStreamsByViewerCount($limit = 100, $orderBy = 'desc'): array
    {
        return Stream::select('stream_title', 'viewer_count')
            ->orderBy('viewer_count', $orderBy)
            ->take($limit)
            ->get()
            ->toArray();
    }

    public static function getMedianNumberOfViewers(): int
    {
        $streams = Stream::all();
        return $streams->median('viewer_count');
    }
}
