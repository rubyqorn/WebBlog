<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	/**
	* @return five records with categories 
	*/ 
	public function getFiveNews()
	{
		return $this->join('news_categories', 'news.category_id', 'news_categories.category_id')
					->take(5)
					->get();
	}
}
