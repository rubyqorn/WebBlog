<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Charts\ArticlesCommentsChart;
use Illuminate\Http\Request;
use App\ArticleComment;

class ArticlesCommentsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.articles-comments')) {
            abort(404);
        }

        $chart = new ArticlesCommentsChart();
        $chart = $chart->create();

        return view('dashboard.articles-comments')
            ->withTitle('Articles Comments')
            ->withChart($chart);
    }

    public function comments()
    {
        return ArticleComment::with('article')
            ->with('users')
            ->orderByDesc('created_at')
            ->paginate(5);
    }
}
