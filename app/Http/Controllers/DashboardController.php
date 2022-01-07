<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $params = [
            'user' => Auth::user(),
            'median' => Stream::getMedianNumberOfViewers(),
            'lowestStream' => 'user_name' . ' | ' . 'game_name',
            'number' => 0
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
        if ($orderBy == 'asc') {
            asort($streams);
        }

        return view('dashboard.top-streams-by-viewer', ['streams' => $streams, 'orderBy' => $orderBy]);
    }
}
