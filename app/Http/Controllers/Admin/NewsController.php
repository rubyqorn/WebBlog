<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\NewsCategory;
use App\News;

class NewsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (view()->exists('templates.admin.news')) {
            $chart = CountRecordsForCharts::chart(new News(), 'doughnut', [
                'backgroundColor' => [
                    'darkslateblue', 'black', 'grey', 'gray',
                    'lightblue', 'darkseagreen', 'coral', 'aqua',
                    'burlywood', 'pink', 'orange', 'violet'
                ]
            ]);
            $news = News::paginate(5);
            $categories = NewsCategory::all();

            return view('templates.admin.news')->with([
                'chart' => $chart,
                'news' => $news,
                'categories' => $categories
            ]);
        }

        abort(404);
        
    }

    /**
     * Search news by request content
     * 
     * @param \Illuminate\Http\Request
     *  
     * @return \Illuminate\Http\Response
    */ 
    public function search(Request $request)
    {
        $news = News::searchNews($request);
        $categories = NewsCategory::all();

        return view('templates.admin.search-content', compact('categories', 'news'));
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
                return redirect()->back()->withStatus('Record was updated successfully'); 
            }
        }
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
                return redirect()->back()->withStatus('Record was deleted successfully');
            }

        }
    }
}
