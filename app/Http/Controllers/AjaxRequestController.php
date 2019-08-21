<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Article;

class AjaxRequestController extends Controller
{
	private $news;

	private $article;

	public function __construct()
	{
		$this->news = new News();
		$this->article = new Article();
	}

    public function getData()
    {
    	$news = $this->news->newsWithPagination();
    	$articles = $this->article->articlesWithPagination();

    	return view('templates.content.ajax-data', compact('news', 'articles'));
    }
}
