<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';

	/**
	* @return Relationships with App\NewsCategory
	*/ 
	public function categories()
	{
		return $this->hasMany(NewsCategory::class, 'category_id');
	}

	/**
	* Select three random news
	*
	* @return three random records
	*/ 
	public function getThreeRandomNews()
	{
		return News::inRandomOrder()->limit(3)->get();
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

	/**
	* Get five latest news for sidebar section
	*
	* @return five latest records
	*/ 
	public function getLastNews()
	{
		return News::orderBy('created_at', 'desc')->take(5)->get();
	}

	/**
	* Select from database news by id
	*
	* @param $id int|string
	*
	* @return record by id property
	*/ 
	public function selectNewsById($id)
	{
		return News::find($id);
	}

	public function newsByCategory($id)
	{
		return News::where('category_id', $id)->paginate(5);
	}

}
