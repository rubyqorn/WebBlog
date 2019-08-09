<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'articles_categories';

    public function getCategories()
    {
    	return $this->select('category_id', 'name')->orderBy('created_at', 'desc')->get();
    }
}
