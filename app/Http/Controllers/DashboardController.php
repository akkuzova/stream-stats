<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use App\Services\UserStatsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends BaseController
{
    protected UserStatsService $propertiesService;

    public function __construct(UserStatsService $propertiesService)
    {
        $this->propertiesService = $propertiesService;
    }

    public function index(): View
    {
        return view('main');
    }

    public function getPersonalStats(): View
    {
        list($lowestStreamName, $numberOfViewsNeeded) = $this->propertiesService->getNumberOfViewsNeeded();

        $params = [
            'user' => Auth::user(),
            'median' => Stream::getMedianNumberOfViewers(),
            'lowestStream' => $lowestStreamName,
            'number' => $numberOfViewsNeeded,
            'tags' => $this->propertiesService->getFollowingWithTopTagsIntersection(),
            'streams' => $this->propertiesService->getFollowingWithTopStreamsIntersection(),
        ];

        return view('dashboard.personal-stats', $params);
    }

    public function getStreamCountByGame(): View
    {
        $games = Stream::getStreamCountByGame();

        return view('dashboard.streams-by-game', ['games' => $games]);
    }

    public function getTopGamesByViewerCount(): View
    {
        $games = Stream::getTopGamesByViewerCount();
        return view('dashboard.games-by-viewer', ['games' => $games]);
    }

    public function getTop100StreamsByViewerCount(Request $request): View
    {
        $orderBy = $request->query->get('order_by') ?: 'desc';

        $streams = Stream::getStreamsByViewerCount();
        if ($orderBy === 'asc') {
            $streams = array_reverse($streams);
        }

        return view('dashboard.top-streams-by-viewer', ['streams' => $streams, 'orderBy' => $orderBy]);
    }

    public function getStreamsByStartTime(Request $request): View
    {
        $streams = Stream::all();
        $streamsByDate = [];

        foreach ($streams as $stream) {
            $date = $this->roundToNearestHour($stream->started_at);
            $streamsByDate[strtotime($date)][] = $stream;
        }

        krsort($streamsByDate);

        return view('dashboard.streams-by-start-time', ['streams' => $streamsByDate]);
    }

    protected function roundToNearestHour(string $date): string
    {
        $dateOriginal = date_create($date);
        $dateRounded = date_create($date)
            ->setTime($dateOriginal->format('H'), 0, 0);

        $interval = $dateOriginal->diff($dateRounded);
        if ($interval->i >= 30) {
            $dateRounded->add(new \DateInterval('PT1H'));
        }

        return date_format($dateRounded, "Y-m-d H:00:00");
    }
}
