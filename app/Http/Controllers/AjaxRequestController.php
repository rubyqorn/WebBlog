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
    	$news = News::paginate(5);
    	$articles = Article::paginate(5);
    	$discussions = Discussion::paginate(5);

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
    	$news = News::where('category_id', $id)->get();
        $articles = Article::where('category_id', $id)->get();
        $discussions = Discussion::withCount('answers')->where('category_id', $id)
                                ->paginate(5);

    	return view('templates.content.categories-content')->with([
            'news' => $news, 'articles' => $articles,
            'discussions' => $discussions
        ]);
    }
}
