<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\DiscussionCategory;

class DiscussionsController extends Controller
{
	/**
	* @var object App\Discussion
	*/ 
	private $discussion;

	/**
	* @var object App\DiscussionCategory
	*/ 
	private $categories;

	public function __construct()
	{
		$this->discussion = new Discussion();
		$this->categories = new DiscussionCategory();
	}

    /**
     * @return discussions page 
    */
    public function showPage()
    {
        if (view()->exists('templates.discussions')) {
        	return view('templates.discussions');
        }

        abort(404);
    }
}
