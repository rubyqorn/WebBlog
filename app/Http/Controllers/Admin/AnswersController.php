<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Http\Requests\StoreResponses;
use App\Answer;

class AnswersController extends Controller
{
    /**
    * @var object App\Answer
    */ 
    private $answer;

    public function __construct()
    {
        $this->answer = new Answer();
    }

	/**
	* Get page with answers table
	*
	* @return answers table 
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.answers')) {
            $chart = CountRecordsForCharts::chart($this->answer);
            $answers = $this->answer->getAnswersForTable();

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
    * @param \App\Http\Requests\StoreResponses
    * @param $id int
    *
    * @return \Illuminate\Http\Response
    */ 
    public function update(StoreResponses $request, $id)
    {
        if ($request->isMethod('put')) {
            $this->answer->updateAnswer($request, $id);

            return redirect()->back()->withStatus('Answer was updated successfully');
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
            $this->answer->deleteAnswer($id);

            return redirect()->back()->withStatus('Answer was deleted successfully');
        }
    }
}
