<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
	/**
	* Get page with comments table
	*
	* @return comments table
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.comments')) {
    		return view('templates.admin.comments');
    	}

    	abort(404);
    	
    }
}
