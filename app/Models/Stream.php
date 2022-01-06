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
        'viewers_number',
        'started_at',
        'tags'
    ];

    public static function truncateAndInsert(array $streams)
    {
        DB::transaction(function () use ($streams) {
            Stream::whereNotNull('id')->delete();
            Stream::insert($streams);
        });
    }
}
