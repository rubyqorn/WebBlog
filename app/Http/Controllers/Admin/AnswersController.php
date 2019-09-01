<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
{
	/**
	* Get page with answers table
	*
	* @return answers table 
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.answers')) {
    		return view('templates.admin.answers');
    	}

    	abort(404);

    }
}
