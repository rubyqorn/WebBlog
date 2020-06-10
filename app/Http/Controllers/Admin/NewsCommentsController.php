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

    public function search(Request $request)
    {
        return NewsComment::with('news')
            ->with('user')
            ->where('comment', 'like', '%' . $request->comment . '%')
            ->paginate(5);
    }

    public function selectedComment($id)
    {
        return NewsComment::with('user')->with('news')->where('id', $id)->get();
    }

    public function edit()
    {
        if (!view()->exists('dashboard.edit-news-comments')) {
            return abort(404);
        }

        return view('dashboard.edit-news-comments')
            ->withTitle('Edit News Comment');
    }

    public function update(Request $request)
    {
        $commentData = $request->validate([
            'comment' => 'required|min:3|max:500'
        ]);

        $comment = NewsComment::findOrFail($request->id);
        $comment->comment = $commentData['comment'];
        $comment->save();

        return response()->json([
            'status_code' => '200',
            'message' => 'Comment was updated!'
        ]);
    }
}
