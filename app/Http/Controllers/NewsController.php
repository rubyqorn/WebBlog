<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsCategory;

class NewsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
    */
    public function showPage()
    {
       $news = News::paginate(5);
       $categories = Newscategory::orderBy('created_at', 'desc')->get();

        if (view()->exists('templates.news')) {
        	return view('templates.news')->with([
        		'news' => $news,
                'categories' => $categories
        	]);
        }
        
        abort(404);
    }

    /**
    * Get single record by id from query string
    *
    * @param $id int|string
    *
    * @return single news 
    */ 
    public function newsById($id)
    {
        $newsContent = $this->news->selectNewsById($id);
        $latestNews = $this->news->getLastNews();
        $categories = $this->categories->getCategories();

        if (view()->exists('templates.article')) {
            return view('templates.article')->with([
                'news' => $newsContent,
                'categories' => $categories,
                'latestNews' => $latestNews
            ]);
        }

        abort(404);
    }

    /**
    * Search news by request property 
    * 
    * @param \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response
    */ 
    public function search(Request $request)
    {
        $news = $this->news->searchNews($request);

        return view('templates.search', compact('news'));
    }
}
