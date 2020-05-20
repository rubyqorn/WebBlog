<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleComment;

class ArticlesCommentsController extends Controller
{
    public function comments($id) 
    {
        return ArticleComment::where('article_id', $id)->orderBy('created_at', 'DESC')
                ->with('users')
                ->get();
    }

    public function storeComment(Request $request, $id)
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $data = $request->validate([
            'comment' => 'required|min:3|max:500',
        ]);

        $comment = auth()->user()->articleComment()->create([
            'user_id' => \Auth::user()->id,
            'article_id' => $id,
            'comment' => $data['comment']
        ]);

        return redirect()->back()->withStatus('Комментарий оставлен');
    }
}
