<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\ArticleCategory;

class ArticlesController extends Controller
{
	/**
	* @var object App\Article
	*/ 
	private $article;

	/**
	* @var object App\ArticleCategory
	*/
	private $categories;

	public function __construct()
	{
		$this->article = new Article();
		$this->categories = new ArticleCategory();
	}

    /**
     * @return articles page
    */
    public function showPage()
    {
    	$articles = $this->article->articlesWithPagination();
    	$categories = $this->categories->getCategories();

        if (view()->exists('templates.articles')) {
        	return view('templates.articles')->with([
        		'articles' => $articles,
        		'categories' => $categories
        	]);
        }
        
        abort(404);
    }
}
