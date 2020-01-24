<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\ArticleCategory;
use App\Article;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (view()->exists('templates.admin.articles')) {
            $chart = CountRecordsForCharts::chart(new Article());
            $articles = Article::paginate(5);
            $categories = ArticleCategory::all();

            return view('templates.admin.articles')->with([
                'chart' => $chart,
                'articles' => $articles,
                'categories' => $categories
            ]);
        }

        abort(404);

    }

    /**
     * Search articles by request content
     * 
     * @param \Illuminate\Http\Request
     *  
     * @return \Illuminate\Http\Response
    */ 
    public function search(Request $request)
    {
        $articles = Article::searchArticles($request);
        $categories = ArticleCategory::all();
        return view('templates.admin.search-content', compact('articles', 'categories'));
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
            $deletinon = Article::deleteArticles($id);

            if ($deletion) {
                return redirect()->back()->withStatus('Article was deleted successfully');
            }
        }
    }
}
