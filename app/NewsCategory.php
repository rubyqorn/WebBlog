<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
	protected $table = 'news_categories';

	/**
	* @return inverse relationships with App\News
	*/ 
	public function news()
	{
		return $this->belongsTo(News::class);
	}

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
