<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoriesController;
use App\NewsCategory;

class NewsCategoriesController extends CategoriesController
{
    /**
     * Get news categories page
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function showPage()
    {
        if (view()->exists('templates.admin.content.categories-content')) {
            $news = NewsCategory::paginate(5);
            return view('templates.admin.content.categories-content', compact('news'));
        }
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
