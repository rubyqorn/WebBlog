<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsCategory;
use App\ArticleCategory;

class CategoriesController extends Controller
{
    private $newsCategory; 

    private $articleCategory;

    public function __construct()
    {
        $this->articleCategory = new ArticleCategory();
        $this->newsCategory = new NewsCategory();
    }

	/**
	* Get page with categories table
	*
	* @return categories table
	*/ 
    public function showPage()
    {
    	if (view()->exists('templates.admin.categories')) {
            $article = $this->articleCategory->getCategoriesForTable();
            $news = $this->newsCategory->getCategoriesForTable();

    		return view('templates.admin.categories')->with([
                'article' => $article,
                'news' => $news
            ]);
    	}

    	abort(404);

    }
}
