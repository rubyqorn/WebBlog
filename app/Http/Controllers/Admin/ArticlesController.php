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

            // dd($articles);

            return view('templates.admin.articles')->with([
                'chart' => $chart,
                'articles' => $articles,
                'categories' => $categories
            ]);
        }

        abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
