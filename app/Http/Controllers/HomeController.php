<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\News;

class HomeController extends Controller
{
	/**
	* @var object App\Article 
	*/ 
	protected $article;

	/**
	* @var object App\News
	*/ 
	protected $news;

	public function __construct(Article $article, News $news)
	{
		$this->article = $article;
		$this->news = $news;
	}

    /**
     * @return home page 
    */
    public function showPage()
    {
    	$news = $this->news->getFiveNews();
    	$articles = $this->article->getSixArticles();

    	if (view()->exists('templates.home')) {
    		return view('templates.home')->with([
    			'articles' => $articles,
    			'news' => $news
    		]);
    	}

    	abort(404);
    }
}
