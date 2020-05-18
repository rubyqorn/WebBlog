<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

        return view('single-article')->withArticle($article);
    }

    public function comments($id) 
    {
        return ArticleComment::where('article_id', $id)->orderBy('created_at', 'DESC')
                ->with('users')
                ->get();
    }

    public function search(Request $request)
    {
        if ($request->category == null) {
            return Article::where('title', 'like', '%' . $request->searching . '%')->get();
        }

        $categoryId = ArticleCategory::select('category_id')
            ->where('name', $request->category)
            ->get();
        $articlesWithCategory = DB::table('articles')
            ->whereRaw("title = '{$request->searching}' and 
                category_id = {$categoryId['0']->category_id}"
            )
            ->get();

        return $articlesWithCategory;
    }

    public function storeComment(Request $request, $id)
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $data = $request->validate([
            'comment' => 'required|min:3|max:500',
        ]);

        $comment = auth()->user()->articleComment()->create([
            'user_id' => \Auth::user()->id,
            'article_id' => $id,
            'comment' => $data['comment']
        ]);

        return redirect()->back()->withStatus('Комментарий оставлен');
    }
}
