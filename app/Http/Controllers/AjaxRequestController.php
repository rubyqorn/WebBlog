<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Article;
use App\Discussion;

class AjaxRequestController extends Controller
{
    /**
    * @var object App\News
    */ 
	private $news;

    /**
    * @var object App\Article
    */ 
	private $article;

    /**
    * @var object App\Discussion
    */ 
	private $discussion;

	public function __construct()
	{
		$this->news = new News();
		$this->article = new Article();
		$this->discussion = new Discussion();
	}

    /**
    * Get page with data which wewill use for ajax requests
    */ 
    public function getData()
    {
    	$news = $this->news->newsWithPagination();
    	$articles = $this->article->articlesWithPagination();
    	$discussions = $this->discussion->getDiscussions();

    	return view('templates.content.ajax-data', compact(
    		'news', 'articles', 'discussions'
    	));
    }

    /**
    * Page with posts by category id
    *
    * @param $id int contains category id which 
    * will give us a records by it
    *
    * @return page with records by category id
    */ 
    public function recordsByCategory($id)
    {
    	$news = $this->news->newsByCategory($id);
        $articles = $this->article->articlesById($id);
        $discussions = $this->discussion->getDiscussionsById($id);

    	return view('templates.content.categories-content')->with([
            'news' => $news, 'articles' => $articles,
            'discussions' => $discussions
        ]);
    }
}
