<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Answer;

class AnswersController extends Controller
{
	/**
	* Get page with answers table
	*
	* @return \Illuminate\Http\Response
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.answers')) {
            $chart = CountRecordsForCharts::chart(new Answer());
            $answers = Answer::paginate(5);

    		return view('templates.admin.answers')->with([
                'chart' => $chart,
                'answers' => $answers
            ]);
    	}

    	abort(404);
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
                return redirect()->back()->withStatus('Answer was updated successfully');
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
                return redirect()->back()->withStatus('Answer was deleted successfully');
            }
        }
    }
}
