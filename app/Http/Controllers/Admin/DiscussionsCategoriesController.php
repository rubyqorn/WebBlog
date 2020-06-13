<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\DiscussionsCategoriesChart;
use App\DiscussionCategory;

class DiscussionsCategoriesController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.discussions-categories')) {
            abort(404);
        }

        $chart = new DiscussionsCategoriesChart();

        return view('dashboard.discussions-categories')
            ->withTitle('Discussions Categories')
            ->withChart($chart->create());
    }

    public function categories()
    {
        return DiscussionCategory::orderByDesc('created_at')
            ->paginate(5);
    }

    public function search(Request $request) 
    {
        return DiscussionCategory::where('name', 'like', '%' . $request->name . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create() 
    {
        if (!view()->exists('dashboard.create-discussions-categories')) {
            return abort(404);
        }

        return view('dashboard.create-discussions-categories')
            ->withTitle('Create Discussions Categories');
    }

    public function store(Request $request)
    {
        $categoryData = $request->validate([
            'name' => 'required|min:3|max:20',
            'color' => 'required'
        ]);

        DiscussionCategory::create([
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
        return DiscussionCategory::where('category_id', $id)
            ->get();
    }

    public function edit() 
    {
        if (!view()->exists('dashboard.edit-discussions-categories')) {
            return abort(404);
        }

        return view('dashboard.edit-discussions-categories')
            ->withTitle('Edit Discussions Category');
    }

    public function update(Request $request)
    {
        $categoryData = $request->validate([
            'name' => 'required|min:3|max:20',
            'color' => 'required'
        ]);

        $category = DiscussionCategory::findOrFail($request->id);

        $category->name = $categoryData['name'];
        $category->color = $categoryData['color'];
        $category->save();

        return response()->json([
            'status_code' => '200',
            'message' => "Category with {$request->id} id was edited"
        ]);
    }

    public function delete($id)
    {
        DiscussionCategory::where('category_id', $id)->delete();

        return response()->json([
            'status_code' => '200',
            'message' => "Category with {$id} id was deleted!"
        ]);
    }
}
