<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Requests\StoreCategories;

class DiscussionsCategoriesController extends CategoriesController
{
    /**
     * Get discussions categories page
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function showPage()
    {
        if (view()->exists('templates.admin.content.categories-content')) {
            $discussions = $this->discussionCategory->getCategoriesForTable();
            return view('templates.admin.content.categories-content', compact('discussions'));
        }
    }

    /**
     * Store articles categories in database
     * 
     * @param \App\Http\Requests\StoreCategories $request
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function storeCategories(StoreCategories $request)
    {
        parent::store($request, $this->discussionCategory);
        return redirect('admin/categories')->withStatus('Category was aded successfully');
    }

     /**
     * Update articles categories by id property
     * 
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     * 
     * @return \Illuminate\Http\Response
    */ 
    public function updateCategories(StoreCategories $request, $id)
    {
        parent::update($request, $this->discussionCategory, $id);
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
        parent::destroy($request, $this->discussionCategory, $id);
        return redirect('admin/categories')->withStatus('Category was deleted successfully');
    }
}
