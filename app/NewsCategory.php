<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\News;

class NewsCategory extends Model
{
    /**
    * Get all categories from database
    *
    * @return records from database by created_at column
    */ 
    public function getCategories()
    {
    	return $this->select('category_id', 'name')->orderBy('created_at', 'desc')->get();
    }
}
