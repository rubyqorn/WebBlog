<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\News;
use App\User;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
    */
    public function showPage()
    {
		$articles =  Article::orderBy('created_at', 'desc')->limit(6)->get(); 
        $lastNews = News::latest()->take(1)->get();
        $news = News::inRandomOrder()->limit(3)->get();
        
    	if (view()->exists('templates.home')) {
    		return view('templates.home')->with([
    			'articles' => $articles,
                'lastNews' => $lastNews,
                'newsItems' => $news
    		]);
    	}
    	abort(404);
    }
}
