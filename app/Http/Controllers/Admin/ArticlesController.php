<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\ArticlesItemsChart;
use App\ArticleCategory;
use App\Article;

class ArticlesController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.articles')) {
            abort(404);
        }

        $chart = new ArticlesItemsChart();
        $chart = $chart->create();

        return view('dashboard.articles')
            ->withTitle('Articles')
            ->withChart($chart);
    }
    
    public function articles()
    {
        return Article::with('category')
            ->with('author')
            ->withCount('comments')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function search(Request $request)
    {
        return Article::with('category')
            ->with('author')
            ->withCount('comments')
            ->where('title', 'like', '%' . $request->title . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create()
    {
        if (!view()->exists('dashboard.create-articles')) {
            return abort(404);
        }

        return view('dashboard.create-articles')
            ->withTitle('Create Article')
            ->withCategories(ArticleCategory::all());
    }

    protected function getCategoryIdByName(string $name)
    {
        return ArticleCategory::select('category_id')
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public function store(Request $request)
    {
        $articleData = $request->validate([
            'title' => 'required|min:10|max:70',
            'description' => 'required|min:120',
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put(
            $image->getFileName() . '.' . $extension, File::get($image)
        );

        $categoryId = $this->getCategoryIdByName($request->category)['0']['category_id'];
        Article::create([
            'category_id' => $categoryId,
            'user_id' => \Auth::user()->id,
            'title' => $articleData['title'],
            'description' => $articleData['description'],
            'image' => $image->getFileName() . '.' . $extension
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Article created!'
        ]);
    }

    public function selectedPost($id)
    {
        return Article::where('id', $id)->get();
    }

    public function edit()
    {
        if(!view()->exists('dashboard.edit-articles')) {
            return abort(404);
        }

        return view('dashboard.edit-articles')
            ->withTitle('Edit Article')
            ->withCategories(ArticleCategory::all());
    }

    public function update(Request $request)
    {
        $articleData = $request->validate([
            'title' => 'required|min:10|max:70',
            'description' => 'required|min:120',
            'category' => 'required'
        ]);

        $article = Article::findOrFail($request->id);
        $article->title = $articleData['title'];
        $article->description = $articleData['description'];
        $article->category_id = $articleData['category'];
        $article->save();

        return response()->json([
            'status_code' => '200',
            'message' => "Post with {$request->id} id was updated"
        ]);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $deletion = Article::deleteArticles($id);

            if ($deletion) {
                return redirect()->route('articles.index')->withStatus('Article was deleted successfully');
            }
        }

        abort(404);
    }
}
