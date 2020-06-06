<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleComment;

class ArticlesCommentsController extends Controller
{
    public function comments($id) 
    {
        return ArticleComment::where('article_id', $id)->orderBy('created_at', 'DESC')
                ->with('user')
                ->get();
    }

    public function latestComment()
    {
        return ArticleComment::with('user')->latest()->first();
    }

    public function storeComment(Request $request)
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $data = $request->validate([
            'comment' => 'required|min:3|max:500',
        ]);

        $comment = auth()->user()->articleComment()->create([
            'user_id' => \Auth::user()->id,
            'article_id' => $request->id,
            'comment' => $data['comment']
        ]);

        return response()->json([
            'status_code' => '200',
            'message' => 'Комментарий оставлен'
        ]);
    }
}
