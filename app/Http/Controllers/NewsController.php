<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsCategory;

class NewsController extends Controller
{
    /**
    * @var object App\News
    */ 
    private $news;

    /**
    * @var object App\NewsCategory
    */ 
    private $categories;

    public function __construct()
    {
        $this->news = new News();
        $this->categories = new NewsCategory();
    }

    /**
     * @return news page 
    */
    public function showPage()
    {
       $news = $this->news->newsWithPagination();
       $categories = $this->categories->getCategories();

        if (view()->exists('templates.news')) {
        	return view('templates.news')->with([
        		'news' => $news,
                'categories' => $categories
        	]);
        }
        
        abort(404);
    }

    /**
    * Get single record by id from query string
    *
    * @param $id int|string
    *
    * @return single news 
    */ 
    public function newsById($id)
    {
        $newsContent = $this->news->selectNewsById($id);
        $latestNews = $this->news->getLastNews();
        $categories = $this->categories->getCategories();

        if (view()->exists('templates.article')) {
            return view('templates.article')->with([
                'news' => $newsContent,
                'categories' => $categories,
                'latestNews' => $latestNews
            ]);
        }

        abort(404);
    }
}
