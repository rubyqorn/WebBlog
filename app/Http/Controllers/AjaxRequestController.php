<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Article;
use App\Discussion;

class AjaxRequestController extends Controller
{
	private $news;

	private $article;

	private $discussion;

	public function __construct()
	{
		$this->news = new News();
		$this->article = new Article();
		$this->discussion = new Discussion();
	}

    public function getData()
    {
    	$news = $this->news->newsWithPagination();
    	$articles = $this->article->articlesWithPagination();
    	$discussions = $this->discussion->getDiscussions();

    	return view('templates.content.ajax-data', compact(
    		'news', 'articles', 'discussions'
    	));
    }
}
