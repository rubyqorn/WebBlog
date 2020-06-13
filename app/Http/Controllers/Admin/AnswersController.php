<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\DiscussionsAnswersChart;
use App\Discussion;
use App\Answer;

class AnswersController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.discussions-answers')) {
            abort(404);
        }

        $chart = new DiscussionsAnswersChart();

        return view('dashboard.discussions-answers')
            ->withTitle('Discussions Answers')
            ->withChart($chart->create());
    }

    public function answers()
    {
        return Answer::with('user')
            ->with('discussion')
            ->paginate(5);
    }

    public function search(Request $request) 
    {
        return Answer::with('user')
            ->with('discussion')
            ->where('answer', 'like', '%' . $request->answer . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create()
    {
        if (!view()->exists('dashboard.create-discussions-answers')) {
            return abort(404);
        }

        $discussions = Discussion::select('id')
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.create-discussions-answers')
            ->withTitle('Create Answers')
            ->withDiscussions($discussions);
    }

    public function store(Request $request)
    {
        $answersData = $request->validate([
            'answer' => 'required|min:10',
            'discussion' => 'required'
        ]);

        Answer::create([
            'user_id' => \Auth::user()->id,
            'discussion_id' => $answersData['discussion'],
            'answer' => $answersData['answer']
        ]);

        return response()->json([
            'status_code' => '200',
            'message' => 'Answer created!'
        ]);
    }

    public function selectedAnswer($id)
    {
        return Answer::with('user')
            ->with('discussion')
            ->where('id', $id)
            ->get();
    }

    public function edit()
    {
        if (!view()->exists('dashboard.edit-discussions-answers')) {
            return abort(404);
        }

        return view('dashboard.edit-discussions-answers')
            ->withTitle('Edit Discussion Answers');
    }

    public function update(Request $request)
    {
        $answerData = $request->validate([
            'answer' => 'required|min:10'
        ]);

        $answer = Answer::findOrFail($request->id);

        $answer->answer = $answerData['answer'];
        $answer->save();

        return response()->json([
            'status_code' => '200',
            'message' => "Answer with {$request->id} id was edited!"
        ]);
    }

    public function delete($id)
    {
        Answer::where('id', $id)->delete();

        return response()->json([
            'status' => '200', 
            'message' => "Answer with {$id} id was deleted!"
        ]);
    }
}
