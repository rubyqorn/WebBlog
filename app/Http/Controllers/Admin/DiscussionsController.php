<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\DiscussionsItemsChart;
use App\DiscussionCategory;
use App\Discussion;

class DiscussionsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.discussions')) {
            abort(404);
        }

        $chart = new DiscussionsItemsChart();
        $chart = $chart->create();

        return view('dashboard.discussions')
            ->withTitle('Discussions')
            ->withChart($chart);
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
                return redirect()->route('discussions.index')->withStatus('Record was updated successfully');
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

            return redirect()->route('discussions.index')->withStatus('Discussion was deleted successfully');
        }
    }
}
