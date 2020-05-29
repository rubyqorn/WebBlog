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

    /**
     * Store articles categories in database 
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function storeCategories(Request $request)
    {
        parent::store($request, new ArticleCategory());
        return redirect('admin/categories')->withStatus('Category was added successfully');
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
        parent::update($request, new ArticleCategory(), $id);
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
        parent::destroy($request, new ArticleCategory(), $id);
        return redirect('admin/categories')->withStatus('Category was deleted successfully');
    }
}
