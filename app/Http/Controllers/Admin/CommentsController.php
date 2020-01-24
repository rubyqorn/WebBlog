<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Comment;

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
            $chart = CountRecordsForCharts::chart($this->comment);
            $comments = Comment::paginate(5);

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
    * @param \Illuminate\Http\Request $request
    * @param $id int
    *
    * @return \Illuminate\Http\Response
    */ 
    public function update(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $updating = Comment::updateComment($request, $id);

            if ($updating) {
                return redirect()->back()->withStatus('Comment was updated successfully');
            }   
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
            $deletion = Comment::deleteComment($id);

            if ($deletion) {
                return redirect()->back()->withStatus('Comment was deleted successfully');
            }
        }
    }
}
