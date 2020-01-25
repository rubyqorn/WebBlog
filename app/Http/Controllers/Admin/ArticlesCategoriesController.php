<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoriesController;
use App\ArticleCategory;

class ArticlesCategoriesController extends CategoriesController
{
    /**
     * Get articles categories page
     *  
     * @return \Illuminate\Http\Response
    */ 
    public function showPage()
    {
        if (view()->exists('templates.admin.content.categories-content')) {
            $articles = ArticleCategory::paginate(5);

            return view('templates.admin.content.categories-content', compact('articles'));
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
