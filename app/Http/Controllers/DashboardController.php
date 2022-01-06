<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', ['user' => Auth::user()]);
    }

    public function getStreamCountByGame()
    {
        return view('dashboard.streams-by-game', ['games' => []]);
    }

    public function getTopGamesByViewerCount()
    {
        return view('dashboard.games-by-viewer', ['games' => []]);
    }

    public function getTop100StreamsByViewerCount(Request $request)
    {
        $orderBy = $request->query->get('order_by') ?: 'desc';
        $streams = [];
        if ($orderBy == 'asc'){
            asort($streams);
        }

        return view('dashboard.top-streams-by-viewer', ['streams' => [], 'orderBy' => $orderBy]);
    }
}
