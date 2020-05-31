<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\ArticlesItemsChart;
use App\ArticleCategory;
use App\Article;

class ArticlesController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.articles')) {
            abort(404);
        }

        $chart = new ArticlesItemsChart();
        $chart = $chart->create();

        return view('dashboard.articles')
            ->withTitle('Articles')
            ->withChart($chart);
    }
    
    public function articles()
    {
        return Article::with('category')
            ->with('author')
            ->withCount('comments')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function search(Request $request)
    {
        return Article::with('category')
            ->with('author')
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
            $storing = Article::store($request);

            if ($storing) {
                return redirect()->back()->withStatus('Record was added successfully');
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
            $updating = Article::updateArticles($request, $id);

            if ($updating) {
                return redirect()->route('articles.index')->withStatus('Record was updated successfully');
            } 
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
            $deletion = Article::deleteArticles($id);

            if ($deletion) {
                return redirect()->route('articles.index')->withStatus('Article was deleted successfully');
            }
        }

        abort(404);
    }
}
