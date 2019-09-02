<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Answer;
use App\Comment;
use App\User;
use App\News;

class DashboardController extends Controller
{
    /**
    * @var object App\Answer
    */ 
    private $answer;

    /**
    * @var object App\Comment
    */ 
    private $comment;

    /**
    * @var object App\User
    */ 
    private $user;

    /**
    * @var object App\News
    */ 
    private $news;

    public function __construct()
    {
        $this->answer = new Answer();
        $this->comment = new Comment();
        $this->user = new User();
        $this->news = new News();
    }

	/**
	* Show dashboard page
	*
	* @return dashboard page
	*/ 
    public function showPage()
    {
        $chart = CountRecordsForCharts::chart($this->news);

        $countedAnswers = $this->answer->countedAnswers();
        $countedComments = $this->comment->countedComments();
        $countedUsers = $this->user->countedUsers();
        $lastNews = $this->news->getLastNews();
        $lastComments = $this->comment->getLastComments();

    	if (view()->exists('templates.admin.dashboard')) {
    		return view('templates.admin.dashboard', compact(
                'countedAnswers', 'countedComments', 'countedUsers',
                'lastNews', 'lastComments', 'chart'
            ));
    	}

    	abort(404);
    	
    }
}
