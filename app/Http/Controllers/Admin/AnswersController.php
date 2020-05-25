<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\DiscussionsAnswersChart;
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

    /**
    * Update answers by id property
    *
    * @param \AIlluminate\Http\Request
    * @param $id int
    *
    * @return \Illuminate\Http\Response
    */ 
    public function update(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $updating = Answer::updateAnswer($request, $id);

            if ($updating) {
                return redirect()->route('admin.answers')->withStatus('Answer was updated successfully');
            }
        }
    }

    /**
    * Delete answer by id property
    *
    * @param \Illuminate\Http\Request $request
    * @param $id int
    * 
    * @return \Illuminate\Http\Response
    */ 
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $deletion = Answer::deleteAnswer($id);

            if ($deletion) {
                return redirect()->route('admin.answers')->withStatus('Answer was deleted successfully');
            }
        }
    }
}
