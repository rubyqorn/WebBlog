<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Article;

class IndexController extends Controller
{
    protected $lastNews;
    protected $fiveLastNews;
    protected $articles;

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
