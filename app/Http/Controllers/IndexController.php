<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class IndexController extends Controller
{
    /**
     * @var \App\Article;
     */ 
    protected $article;

    /**
     * @return void
     */ 
    public function showPage()
    {
        $this->article = Article::orderBy('created_at', 'DESC')->take(1)->get();

        return view('main')->with([
            'article' => $this->article,
            'title' => '</webblog>'
        ]);
    }
}
