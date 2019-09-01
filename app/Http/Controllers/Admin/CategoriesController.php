<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
	/**
	* Get page with categories table
	*
	* @return categories table
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.categories')) {
    		return view('templates.admin.categories');
    	}

    	abort(404);

    }
}
