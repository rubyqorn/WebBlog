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
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function search(Request $request)
    {
        return ArticleComment::with('article')
            ->with('user')
            ->where('comment', 'like', '%' . $request->comment . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function selectedComment($id)
    {
        return ArticleComment::with('article')
            ->with('user')
            ->where('id', $id)
            ->get();
    }

    public function edit()
    {
        if (!view()->exists('dashboard.edit-articles-comments')) {
            return abort(404);
        }

        return view('dashboard.edit-articles-comments')
            ->withTitle('Edit Article Comment');
    }

    public function update(Request $request)
    {
        $commentData = $request->validate([
            'comment' => 'required|min:3|max:500'
        ]);

        $comment = ArticleComment::findOrFail($request->id);
        $comment->comment = $commentData['comment'];
        $comment->save();

        return response()->json([
            'status_code' => '200',
            'message' => 'Comment was changed!'
        ]);
    }

    public function delete($id) 
    {
        ArticleComment::where('id', $id)->delete();

        return response()->json([
            'status_code' => '200',
            'message' => "Comment with {$id} id was deleted!"
        ]);
    }
}
