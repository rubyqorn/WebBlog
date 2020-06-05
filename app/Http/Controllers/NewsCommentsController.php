<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsComment;

class NewsCommentsController extends Controller
{
    public function comments(Request $request, $id) 
    {
        return NewsComment::where('news_id', $id)->orderByDesc('created_at')
                ->with('user')
                ->get();
    }

    public function latestComment()
    {
        return NewsComment::with('user')->latest()->first();
    }

    public function storeComment(Request $request) 
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $data = $request->validate([
            'comment' => 'required|min:3|max:500'
        ]);

        $comment = auth()->user()->newsComment()->create([
            'user_id' => \Auth::user()->id,
            'news_id' => $request->id,
            'comment' => $data['comment']
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Комментарий оставлен!'
        ]);

    }
}
