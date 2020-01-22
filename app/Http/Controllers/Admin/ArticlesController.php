<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Http\Requests\StoreRecords;
use App\ArticleCategory;
use App\Article;

class ArticlesController extends Controller
{
    /**
    * @var object App\Article
    */ 
    private $article;

    /**
    * @var object App\ArticleCategory
    */ 
    private $category;

    public function __construct()
    {
        $this->article = new Article();
        $this->category = new ArticleCategory();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (view()->exists('templates.admin.articles')) {
            $chart = CountRecordsForCharts::chart($this->article);
            $articles = $this->article->articlesWithPagination();
            $categories = $this->category->getCategories();

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
        $articles = $this->article->searchArticles($request);
        $categories = $this->category->getCategories();
        return view('templates.admin.search-content', compact('articles', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecords  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->article->store($request);

            return redirect()->back()->withStatus('Record was added successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecords  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRecords $request, $id)
    {
        if ($request->isMethod('patch')) {
            $this->article->updateArticles($request, $id);

            return redirect()->back()->withStatus('Record was updated successfully');
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
            $this->article->deleteArticles($id);

            return redirect()->back()->withStatus('Article was deleted successfully');
        }
    }
}
