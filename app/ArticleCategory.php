<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'articles_categories';
    protected $fillable = ['name'];

    
    /**
    * Select categories names from db table
    *
    * @return categories
    */
    public function getCategories()
    {
    	return $this->select('category_id', 'name')->orderBy('created_at', 'desc')->get();
    }


    /**
     * Get categories for articles table
     *
     * @return articles with pagination
     */
    public function getCategoriesForTable()
    {
        return ArticleCategory::paginate(5);
    }

    /**
     * Store categories 
     * 
     * @param \App\Http\Requests\StoreCategories $request
     * 
     * @return \App\ArticleCategory
    */ 
    public function storeCategories($request)
    {
        if(is_object($request)) {
            $validation = $request->validated();

            return ArticleCategory::create([
                'name' => $request->category
            ]);
        }
    }

    /**
     * Update categories 
     * 
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     * 
     * @return \App\ArticleCategory
    */ 
    public function updateCategories($request, $id)
    {
        if (is_object($request)) {
            $validation = $request->validated();

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
