<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'articles_categories';

    /**
    * @return inverse relationships with App\Article
    */ 
    public function article()
    {
    	return $this->belongsTo(Article::class);
    }

    /**
    * Select categories names from db table
    *
    * @return categories
    */ 
    public function getCategories()
    {
    	return $this->select('category_id', 'name')->orderBy('created_at', 'desc')->get();
    }

    public function getCategoriesForTable()
    {
        return ArticleCategory::paginate(5);
    }
}
