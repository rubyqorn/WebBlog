<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreResponses;
use App\ArticleCategory;
use App\Article;
use App\Comment;

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

    /**
    * @var object App\Comment
    */ 
    private $comment;

	public function __construct()
	{
		$this->article = new Article();
		$this->categories = new ArticleCategory();
        $this->comment = new Comment();
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

    /**
    * Return page with single article where contains
    * main block with article content and 2 sidebars
    * with latest articles and categories names
    *
    * @param $id int|string
    * 
    * @return page with single article
    */ 
    public function showSingleArticle($id)
    {
        $article = $this->article->selectArticleById($id);
        $latestArticles = $this->article->getLatestArticles();
        $comments = $this->comment->getComments($id);
        $articlesCategories = $this->categories->getCategories();

        if (view()->exists('templates.article')) {
            return view('templates.article')->with([
                'article' => $article,
                'latestArticles' => $latestArticles,
                'comments' => $comments,
                'categories' => $articlesCategories,      
            ]);
        }

        abort(404);
    } 

    public function storeComment(StoreResponses $request)
    {
        $validation = $this->comment->store($request);

        return redirect()->back();
    }
}
