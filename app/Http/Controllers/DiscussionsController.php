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
    	$discussions = $this->discussion->getDiscussions();
    	$categories = $this->categories->getCategories();

        if (view()->exists('templates.discussions')) {
        	return view('templates.discussions')->with([
        		'discussions' => $discussions,
        		'categories' => $categories
        	]);
        }

        abort(404); 
    }
}
