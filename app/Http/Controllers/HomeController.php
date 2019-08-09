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

	public function __construct()
	{
		$this->article = new Article();
		$this->news = new News();
	}

    /**
     * @return home page 
    */
    public function showPage()
    {
    	//$news = $this->news->getThreeNews();
    	$articles = $this->article->getSixArticles();
        $lastNews = $this->news->getLatestNews();

    	if (view()->exists('templates.home')) {
    		return view('templates.home')->with([
    			'articles' => $articles,
                'lastNews' => $lastNews,
                //'news' => $news
    		]);
    	}

    	abort(404);
    }
}
