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
    * @var object App\News
    */ 
    private $news;

    /**
    * @var object App\NewsCategory
    */ 
    private $category;

    public function __construct()
    {
        $this->news = new News();
        $this->category = new NewsCategory();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (view()->exists('templates.admin.news')) {
            $chart = CountRecordsForCharts::chart($this->news);
            $news = $this->news->newsWithPagination();
            $categories = $this->category->getCategories();

            return view('templates.admin.news')->with([
                'chart' => $chart,
                'news' => $news,
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
             $this->news->store($request);

             return redirect()->back()->withStatus('Your record was created successfully');
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
