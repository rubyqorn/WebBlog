<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AnswersController extends Controller
{
    public function answers($id)
    {
        return Answer::orderByDesc('created_at')->where('discussion_id', $id)
                ->with('user')
                ->get();
    }

    public function storeAnswers(Request $request, $id)
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $data = $request->validate([
            'answer' => 'required|min:3|max:700'
        ]);

        $answer = Answer::create([
            'user_id' => \Auth::user()->id,
            'discussion_id' => $id,
            'answer' => $data['answer']
        ]);

        return redirect()->back()->withStatus('Ответ оставлен');
    }
}
