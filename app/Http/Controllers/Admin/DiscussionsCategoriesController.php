<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoriesController;

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
}
