<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArticleCategory extends Model
{
    protected $table = 'articles_categories';
    protected $fillable = ['name'];

    /**
     * Store categories 
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \App\ArticleCategory
    */ 
    public function storeCategories(Request $request)
    {
        if(is_object($request)) {
            $validation = $request->validate([
                'name' => 'required|min:5|max:20'
            ]);

            return ArticleCategory::create([
                'name' => $request->category
            ]);
        }
    }

    /**
     * Update categories 
     * 
     * @param \Illuminate\Http\Request $request
     * @param $id int
     * 
     * @return \App\ArticleCategory
    */ 
    public function updateCategories(Request $request, $id)
    {
        if (is_object($request)) {
            $validation = $request->validate([
                'name' => 'required|min:5|max:20'
            ]);

            return ArticleCategory::where('category_id', $id)->update([
                'name' => $request->category
            ]);
        }
    }

    /**
     * Delete categories 
     * 
     * @param $id int
     * 
     * @return \App\ArticleCategory
    */ 
    public function deleteCategories($id)
    {
        return ArticleCategory::where('category_id', $id)->delete();
    }
}
