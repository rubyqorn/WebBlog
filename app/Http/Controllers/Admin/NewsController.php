<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\NewsItemsChart;
use App\NewsCategory;
use App\News;

class NewsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.news')) {
            abort(404);
        }

        $chart = new NewsItemsChart();
        $chart = $chart->create();

        return view('dashboard.news')->withTitle('News')
            ->withChart($chart);
    }

    public function search(Request $request)
    {
        return News::with('category')
            ->withCount('comments')
            ->where('title', 'like', '%' . $request->title . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
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
             $storing = News::store($request);

             if($storing) {
                return redirect()->back()->withStatus('Your record was created successfully');
             }
            
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $updating = News::updateRecords($request, $id); 

            if ($updating) {
                return redirect()->route('news.index')->withStatus('Record was updated successfully'); 
            }

            abort(404);
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $deletion = News::deleteNews($id);

            if($deletion) {
                return redirect()->route('news.index')->withStatus('Record was deleted successfully');
            }

        }
    }
}
