<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	* @return Relationships with App\ArticleCategory
	*/ 
	public function categories()
	{
		return $this->hasMany(ArticleCategory::class, 'category_id');
	}

	/**
	* @return Relationships with App\Comment
	*/ 
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

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

	/**
	* Return record by id 
	*
	* @param id int|string
	*
	* @return record
	*/ 
	public function selectArticleById($id)
	{
		return Article::findOrFail($id);
	}

	/**
	* Get five last articles for sidebar section
	*
	* @return five latest articles
	*/ 
	public function getLatestArticles()
	{
		return Article::orderBy('created_at', 'desc')->take(5)->get();
	}
}
