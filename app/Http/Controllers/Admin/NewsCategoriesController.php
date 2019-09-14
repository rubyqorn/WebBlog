<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoriesController;

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
            $news = $this->newsCategory->getCategoriesForTable();
            return view('templates.admin.content.categories-content', compact('news'));
        }
    }
}
