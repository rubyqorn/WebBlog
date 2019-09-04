<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
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

            //dd($chart);

    		return view('templates.admin.answers')->with([
                'chart' => $chart,
                'answers' => $answers
            ]);
    	}

    	abort(404);

    }
}
