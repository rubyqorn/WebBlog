<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	* @return six records with categories
	*/ 
	public function getSixArticles()
	{
		return $this->join('articles_categories', 'articles.category_id', 'articles_categories.category_id')
					->limit(6)
					->get();
	}

	/**
	* Get all articles with categories from database
	* and replace its with pagination
	*
	* @return records with pagination
	*/ 
	public function articlesWithPagination()
	{
		return Article::join('articles_categories', 'articles.category_id', 'articles_categories.category_id')
						->paginate(5);
	}
}
