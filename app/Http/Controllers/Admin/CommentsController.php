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
            $chart = CountRecordsForCharts::chart(new Comment(), 'polarArea', [
                'backgroundColor' => [
                    '#ffc107', '#dc3545', '#20c997',
                    '#6f42c1', '#17a2b8', '#6c757d',
                    '#28a745', '#e83e8c', '#6dd5e6',
                    '#f0d480', '#c1a1f4', '#007bff'
                ]
            ]);

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
                return redirect()->route('admin.comments')->withStatus('Comment was updated successfully');
            }   

            abort(404);
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
                return redirect()->route('admin.comments')->withStatus('Comment was deleted successfully');
            }

            abort('404');
        }
    }

    /**
     * Search comments 
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */ 
    public function search(Request $request)
    {
        if ($request->isMethod('POST')) {
            $comments = Comment::searchComments($request);

            if ($comments) {
                return view('templates.admin.search-content')->with('comments', $comments);
            }
        }
    }
}
