<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	/**
	* Select news with categories
	*
	* @return news with categories
	*/ 
	public function getThreeNews()
	{
		return $this->join('news_categories', 'news.category_id', 'news_categories.category_id')
					->limit(3)
					->get();
	}

	/**
	* Get records with categories names and pagination
	*
	* @return records with pagination
	*/ 
	public function newsWithPagination()
	{
		return News::join('news_categories', 'news.category_id', 'news_categories.category_id')
					->paginate(5);
	}

	/**
	* @return latest last added record
 	*/ 
	public function getLatestNews()
	{
		return $this->latest()->limit(1)->get();
	}
}
