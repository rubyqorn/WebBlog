<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CheckFile;

class Article extends Model
{
	protected $fillable = [
		'title', 'description', 'image', 'category_id'
	];

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

	/**
	* Get record by id property
	*
	* @param $id int
	*
	* @return single record by id
	*/ 
	public function articlesById($id)
	{
		return Article::where('category_id', $id)->paginate(5);
	}

	/**
	* Get and count records by month
	*
	* @param $month int|string Have to be like 01, 02...
	*
	* @return counted records by month
	*/ 
	public function getRecordsByMonth($month)
	{
		return Article::whereMonth('created_at', $month)->count();
	}

	/**
	* Store articles in database
	*
	* @param $request object App\Http\Requests\StoreRecords
	*
	* @return bool
	*/ 
	public function store($request)
	{
		if (is_object($request)) {
			
			$validation = $request->validated();

			$filename = CheckFile::checkForFileContains($request, 'image');

			return Article::create([
				'title' => $request->title,
				'description' => $request->description,
				'image' => $filename,
				'category_id' => $request->category
			]);

		}
	}

	/**
	* Update articles by id property 
	*
	* @param \App\Http\Requests\StoreRecords $request
	* @param $id int
	*
	* @return updated article
	*/ 
	public function updateArticles($request, $id)
	{
		if (is_object($request)) {

			$validation = $request->validated();

			$filename = CheckFile::checkForFileContains($request, 'image');

			return Article::where('id', $id)->update([
				'title' => $request->title,
				'description' => $request->description,
				'image' => $filename,
				'category_id' => $request->category, 
			]);
		}
	}

	/**
	* Delete articles by id property
	*
	* @param $id int
	*
	* @return bool
	*/ 
	public function deleteArticles($id)
	{
		return Article::where('id', $id)->delete();
	}
}
