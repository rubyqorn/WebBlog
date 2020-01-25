<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\DiscussionCategory;
use App\Discussion;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (view()->exists('templates.admin.discussions')) {
            $chart = CountRecordsForCharts::chart(new Discussion(), 'line', [
                'backgroundColor' => 'deepskyblue',
                'borderColor' => 'dodgerblue'
            ]);

            $discussions = Discussion::paginate(5);
            $categories = DiscussionCategory::all();

            return view('templates.admin.discussions')->with([
                'chart' => $chart,
                'discussions' => $discussions,
                'categories' => $categories,
            ]);
        }

        abort(404);
        
    }

    /**
     * Search discussions by request content
     * 
     * @param \Illuminate\Http\Request
     *  
     * @return \Illuminate\Http\Response
    */ 
    public function search(Request $request)
    {
        $discussions = Discussion::searchDiscussions($request);
        $categories = DiscussionCategory::all();

        return view('templates.admin.search-content', compact('discussions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $storing = Discussion::storeQuestions($request);

            if ($storing) {
                return redirect()->back()->withStatus('Your discussion was created successfully');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $updating = Discussion::updateDiscussions($request, $id);

            if($updating) {
                return redirect()->back()->withStatus('Record was updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $deletion = Discussion::deleteDiscussions($id);

            return redirect()->back()->withStatus('Discussion was deleted successfully');
        }
    }
}
