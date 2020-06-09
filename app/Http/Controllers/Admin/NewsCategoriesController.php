<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\NewsCategoriesChart;
use App\NewsCategory;

class NewsCategoriesController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.news-categories')) {
            abort(404);
        }

        $chart = new NewsCategoriesChart();
        $chart = $chart->create();

        return view('dashboard.news-categories')
            ->withTitle('News Categories')
            ->withChart($chart);
    }

    public function categories()
    {
        return NewsCategory::paginate(5);
    }

    public function search(Request $request)
    {
        return NewsCategory::where('name', 'like', '%' . $request->name . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create()
    {
        if (!view()->exists('dashboard.create-news-categories')) {
            return abort(404);
        }

        return view('dashboard.create-news-categories')
            ->withTitle('Create News Category');
    }
 
    public function store(Request $request)
    {
        $categoryData = $request->validate([
            'name' => 'required|min:3|max:20',
            'color' => 'required'
        ]);

        NewsCategory::create([
            'name' => $categoryData['name'],
            'color' => $categoryData['color']
        ]);

        return response()->json([
            'status' => '200',
            'message' => 'Category created!'
        ]);
    }

    public function selectedCategory($id)
    {
        return NewsCategory::where('category_id', $id)->get();
    }

    public function edit()
    {
        if (!view()->exists('dashboard.edit-news-categories')) {
            return abort(404);
        }

        return view('dashboard.edit-news-categories')
            ->withTitle('Edit News Category');
    }

    public function update(Request $request)
    {
        $categoryData = $request->validate([
            'name' => 'required|min:3|max:20',
            'color' => 'required'
        ]);

        $category = NewsCategory::findOrFail($request->category_id);

        $category->name = $categoryData['name'];
        $category->color = $categoryData['color'];
        $category->save();

        return response()->json([
            'status_code' => '200',
            'message' => "Category with {$request->id} was updated"
        ]);
    }

    /**
     * Delete articles categories by id property
     * 
     * @param \Illuminate\Http\Request $request
     * @param $id int
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function destroyCategories(Request $request, $id)
    {
        parent::destroy($request, new NewsCategory(), $id);
        return redirect('admin/categories')->withStatus('Category was updated successfully');
    }
}
