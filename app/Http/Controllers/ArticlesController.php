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
     * @return \Illuminate\Http\Response
    */
    public function showPage()
    {

        if (!view()->exists('articles')) {
            abort(404);
        }

        $categories = ArticleCategory::orderBy('created_at', 'DESC')->get();

        return view('articles')->with([
            'categories' => $categories
        ]);
    }

    /**
     * @return string
     */ 
    public function articles()
    {
        return Article::with('category')
            ->withCount('comments')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    }

    public function articlesByCategory($id)
    {
        if (!view()->exists('articles-by-category')) {
            abort(404);            
        }

        $articles = Article::orderBy('created_at', 'DESC')
            ->with('category')
            ->with('author')
            ->withCount('comments')
            ->where('category_id', $id)
            ->get();

        $categoryName = ArticleCategory::select('name')
            ->where('category_id', $id)->get();
        $title = "Статьи из категории {$categoryName['0']->name}"; 

        return view('articles-by-category', [
            'title' => $title,
            'articles' => $articles
        ]);

    }

    /**
    * Search articles by request content
    *
    * @param \Illuminate\Http\Request $request
    *
    * @return \Illuminate\Http\Response
    */ 
    public function search(Request $request)
    {
        $articles = Article::searchArticles($request);

        return view('templates.search-content', compact('articles'));
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
        $article = Article::findOrFail($id);
        $latestArticles = Article::orderBy('created_at', 'desc')->limit(5)->get();
        $comments = Comment::where('article_id', $article->id)->paginate(3);

        if (view()->exists('templates.article')) {
            return view('templates.article')->with([
                'article' => $article,
                'latestArticles' => $latestArticles,
                'comments' => $comments,    
            ]);
        }

        abort(404);
    } 

    public function storeComment(Request $request)
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $storeComment = Comment::store($request);

        if ($storeComment) {
            return redirect()->back()->with('status', 'Commented');
        }

        return redirect()->back();
    }
}
