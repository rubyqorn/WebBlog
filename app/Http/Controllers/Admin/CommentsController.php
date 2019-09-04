<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Comment;

class CommentsController extends Controller
{
    /**
    * @var object App\Comment
    */ 
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }

	/**
	* Get page with comments table
	*
	* @return comments table
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.comments')) {
            $chart = CountRecordsForCharts::chart($this->comment);
            $comments = $this->comment->getCommentsForTable();

            // dd($comments);

    		return view('templates.admin.comments')->with([
                'chart' => $chart,
                'comments' => $comments,
            ]);
    	}

    	abort(404);
    	
    }
}
