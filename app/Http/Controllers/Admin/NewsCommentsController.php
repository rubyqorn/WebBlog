<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Charts\NewsCommentsChart;
use Illuminate\Http\Request;
use App\NewsComment;

class NewsCommentsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.news-comments')) {
            abort(404);
        }

        $chart = new NewsCommentsChart();
        $chart = $chart->create();

        return view('dashboard.news-comments')
            ->withTitle('News Comments')
            ->withChart($chart);
    }

    public function comments()
    {
        return NewsComment::with('news')
            ->with('user')
            ->paginate(5);
    }
}
