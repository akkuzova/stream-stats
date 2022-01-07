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
        list($lowestStreamName, $numberOfViewsNeeded) = $this->getNumberOfViewsNeeded();

        $params = [
            'user' => Auth::user(),
            'median' => Stream::getMedianNumberOfViewers(),
            'lowestStream' => $lowestStreamName,
            'number' => $numberOfViewsNeeded,
            'tags' => $this->propertiesService->getFollowingWithTopTagsIntersection(),
            'streams' => $this->propertiesService->getFollowingWithTopStreamsIntersection(),
        ];

        return view('dashboard.index', $params);
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
            asort($streams);
        }

        return view('dashboard.top-streams-by-viewer', ['streams' => $streams, 'orderBy' => $orderBy]);
    }

    public function getStreamsByStartTime(Request $request): View
    {
        $streams = Stream::all();
        $streamsByDate = [];

        foreach ($streams as $stream) {
            $date = $this->roundToNearestHour($stream->started_at);
            $streamsByDate[$date][] = $stream;
        }

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

    protected function getNumberOfViewsNeeded(): array
    {
        $lowestStream = $this->propertiesService->getLowestViewersStreamFromFollowing();
        $lowestStreamInTop = Stream::getStreamsByViewerCount(1, 'asc');
        if (!empty($lowestStream) && !empty($lowestStreamInTop)) {
            $lowestStreamName = $lowestStream['user_name'] . ' | ' . $lowestStream['game_name'];
            $numberOfViewsNeeded = max(0, head($lowestStreamInTop)['viewer_count'] - $lowestStream['viewer_count'] + 1);
        } else {
            $lowestStreamName = 'Not available';
            $numberOfViewsNeeded = -1;
        }
        return [$lowestStreamName, $numberOfViewsNeeded];
    }
}
