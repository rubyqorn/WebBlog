<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\DiscussionCategory;
use App\Answer;

class DiscussionsController extends Controller
{
	/**
	* @var object App\Discussion
	*/ 
	private $discussion;

	/**
	* @var object App\Answer
	*/ 

	/**
	* @var object App\DiscussionCategory
	*/ 
	private $categories;

	public function __construct()
	{
		$this->discussion = new Discussion();
		$this->categories = new DiscussionCategory();
		$this->answer = new Answer();
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

    public function showSingleDiscussion($id)
    {

    	$discussion = $this->discussion->getDiscussionById($id);
    	$answers = $this->answer->getAnswers($id);
    	$latestDiscussions = $this->discussion->getLatestDiscussions();

    	if (view()->exists('templates.discussion')) {
    		return view('templates.discussion')->with([
    			'discussion' => $discussion,
    			'answers' => $answers,
    			'latestDiscussions' => $latestDiscussions
    		]);
    	}

    	abort(404);
    }
}
