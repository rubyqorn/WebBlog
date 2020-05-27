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

    /**
     * Store articles categories in database
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function storeCategories(Request $request)
    {
        parent::store($request, new NewsCategory());
        return redirect('admin/categories')->withStatus('Category was added successfully');
    }

    /**
     * Update articles categories by id property
     * 
     * @param \Illuminate\Http\Request $request
     * @param $id int
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function updateCategories(Request $request, $id)
    {
        parent::update($request, new NewsCategory(), $id);
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
        parent::destroy($request, new NewsCategory(), $id);
        return redirect('admin/categories')->withStatus('Category was updated successfully');
    }
}
