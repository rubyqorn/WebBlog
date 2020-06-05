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

     /**
     * Update articles categories by id property
     * 
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function updateCategories(Request $request, $id)
    {
        parent::update($request, new DiscussionCategory(), $id);
        return redirect('admin/categories')->withStatus('Category was updated successfully');
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
        parent::destroy($request, new DiscussionCategory(), $id);
        return redirect('admin/categories')->withStatus('Category was deleted successfully');
    }
}
