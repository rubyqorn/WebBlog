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
        $categories = NewsCategory::orderBy('created_at', 'desc')->get();

        if (view()->exists('news')) {
        	return view('news')->with([
                'categories' => $categories
        	]);
        }
        
        abort(404);
    }

    /**
     * @return string
     */ 
    public function news()
    {
        return News::with('category')
            ->withCount('comments')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    }

    public function newsByCategory($id) 
    {
        return News::where('category_id', $id)->get();
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
        $newsContent = News::findOrFail($id);
        $latestNews = News::orderBy('created_at', 'desc')->limit(5)->get();

        if (view()->exists('templates.article')) {
            return view('templates.article')->with([
                'news' => $newsContent,
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
        $news = News::searchNews($request);

        return view('templates.search-content', compact('news'));
    }
}
