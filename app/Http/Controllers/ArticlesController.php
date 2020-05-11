<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreResponses;
use App\ArticleCategory;
use App\Article;
use App\ArticleComment;

class ArticlesController extends Controller
{
    public function showPage()
    {

        if (!view()->exists('articles')) {
            abort(404);
        }

        $categories = ArticleCategory::orderBy('created_at', 'DESC')->get();

        return view('articles')->withCategories($categories);
    }

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

        return view('articles-by-category')->withTitle($title)
            ->withArticles($articles);

    }

    public function articleById($id)
    {
        if (!view()->exists('single-article')) {
            abort(404);
        }

        $article = Article::findOrFail($id);
        $comments = ArticleComment::where('article_id', $id)->orderBy('created_at', 'DESC')
            ->with('users')
            ->get();

        return view('single-article')->withArticle($article)->withComments($comments);
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
