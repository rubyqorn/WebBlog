<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArticleCategory extends Model
{
    protected $table = 'articles_categories';
    protected $fillable = ['name', 'color'];
    protected $primaryKey = 'category_id';

    public function articles()
    {
        return $this->hasMany('\App\Article', 'category_id', 'category_id');
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
