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
            $articles = $this->articleCategory->getCategoriesForTable();
            return view('templates.admin.content.categories-content', compact('articles'));
        }  
    }
}
