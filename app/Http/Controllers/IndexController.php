<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Article;

class IndexController extends Controller
{
    /**
     * @var \App\News
     */ 
    protected $lastNews;
    
    /**
     * @var \App\News
     */ 
    protected $fiveLastNews;
    
    /**
     * @var \App\Article
     */ 
    protected $articles;

    /**
     * @return void
     */ 
    public function showPage()
    {
        $this->lastNews = News::orderBy('created_at', 'DESC')->take(1)->get();
        $this->fiveLastNews = News::orderBy('created_at', 'DESC')->take(5)->get();
        $this->articles = Article::orderBy('created_at', 'DESC')->take(6)->get();

        return view('templates.home')->with([
            'lastNews' => $this->lastNews,
            'news' => $this->fiveLastNews,
            'articles' => $this->articles
        ]);
    }
}
