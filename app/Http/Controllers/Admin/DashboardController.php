<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	* Show dashboard page
	*
	* @return dashboard page
	*/ 
    public function showPage()
    {
    	return view('templates.admin.dashboard');
    }
}
