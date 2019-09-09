<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Http\Requests\StoreResponses;
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

    		return view('templates.admin.comments')->with([
                'chart' => $chart,
                'comments' => $comments,
            ]);
    	}

    	abort(404);
    	
    }

    /**
    * Update comments by id property
    *
    * @param \App\Http\Requests\StoreResponses $request
    * @param $id int
    *
    * @return \Illuminate\Http\Response
    */ 
    public function update(StoreResponses $request, $id)
    {
        if ($request->isMethod('put')) {
            $this->comment->updateComment($request, $id);

            return redirect()->back()->withStatus('Comment was updated successfully');
        }
    }

    /**
    * Delete comment by id property
    *
    * @param \Illuminate\Http\Request $request
    * @param $id int
    *
    * @return \Illuminate\Http\Response
    */ 
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $this->comment->deleteComment($id);

            return redirect()->back()->withStatus('Comment was deleted successfully');
        }
    }
}
