<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsCategory;
use App\NewsComment;

class NewsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('news')) {
            abort(404);	
        }
        
        $categories = NewsCategory::orderBy('created_at', 'desc')->get();

        return view('news')->withCategories($categories);
        
    }

    public function news()
    {
        return News::with('category')
            ->withCount('comments')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    }

    public function newsByCategory($id)
    {
        if (!view()->exists('news-by-category')) {
            abort(404);            
        }

        $news = News::orderBy('created_at', 'DESC')
                ->withCount('comments')
                ->with('category')
                ->where('category_id' , $id)
                ->get();

        $categoryName = NewsCategory::select('name')
            ->where('category_id', $id)
            ->get();

        $title = "Новости из категории: {$categoryName['0']->name}";

        return view('news-by-category')->withTitle($title)
            ->withNews($news);

    }

    public function newsById($id)
    {
        if (!view()->exists('single-news')) {
            return abort(404);            
        }

        $newsContent = News::findOrFail($id);
        $comments = NewsComment::where('news_id', $id)->orderBy('created_at', 'DESC')
            ->with('user')
            ->get();

        return view('single-news')->withNews($newsContent)
            ->withComments($comments);

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
