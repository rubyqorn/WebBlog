<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Charts\ArticlesCategoriesChart;
use Illuminate\Http\Request;
use App\ArticleCategory;

class ArticlesCategoriesController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.articles-categories')) {
            abort(404);
        }  

        $chart = new ArticlesCategoriesChart();
        $chart = $chart->create();

        return view('dashboard.articles-categories')
            ->withTitle('Articles Categories')
            ->withChart($chart);
    }

    public function categories()
    {
        return ArticleCategory::orderByDesc('created_at')->paginate(5);
    }

    public function search(Request $request)
    {
        return ArticleCategory::where('name', 'like', '%' . $request->name . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create()
    {
        if (!view()->exists('dashboard.create-articles-categories')) {
            return abort(404);
        }

        return view('dashboard.create-articles-categories')
            ->withTitle('Create Article Category');
    }

    public function store(Request $request)
    {
        $categoryData = $request->validate([
            'name' => 'required|min:3|max:20',
            'color' => 'required'
        ]);

        ArticleCategory::create([
            'name' => $categoryData['name'],
            'color' => $categoryData['color']
        ]);

        return response()->json([
            'status_code' => '200',
            'message' => 'Category created!'
        ]);
    }

    public function selectedCategory($id)
    {
        return ArticleCategory::where('category_id', $id)->get();
    }

    public function edit()
    {
        if (!view()->exists('dashboard.edit-articles-categories')) {
            return abort(404);
        }

        return view('dashboard.edit-articles-categories')
            ->withTitle('Edit Articles Category');
    }

    public function update(Request $request)
    {
        $categoryData = $request->validate([
            'name' => 'required|min:3|max:10',
            'color' => 'required'
        ]);

        $category = ArticleCategory::findOrFail($request->id);
        $category->name = $categoryData['name'];
        $category->color = $categoryData['color'];
        $category->save();

        return response()->json([
            'status' => '200',
            'message' => "Category with {$request->id} id was updated"
        ]);
    }

    public function delete($id)
    {
        ArticleCategory::where('category_id', $id)->delete();

        return response()->json([
            'status_code' => '200',
            'message' => "Category with {$id} id was deleted!"
        ]);
    }
}
