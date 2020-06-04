<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CheckFile;
use Illuminate\Http\Request;

class Article extends Model
{
	protected $fillable = [
		'title', 'description', 'image', 'category_id', 'user_id'
	];

	public function category()
	{
		return $this->belongsTo(ArticleCategory::class, 'category_id', 'category_id');
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function comments()
	{
		return $this->belongsTo(ArticleComment::class, 'id', 'article_id');
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
	 * Search articles
	 * 
	 * @param \Illuminate\Http\Request  
	 * 
	 * @return \App\Article
	*/ 
	public static function searchArticles($request)
	{
		if (is_object($request)) {
			return Article::where('title', $request->search)
							->orWhere('title', 'like', '%' . $request->search . '%')
							->paginate(5);
		}
	}

	/**
	* Store articles in database
	*
	* @param \Illuminate\Http\Request $request 
	*
	* @return bool
	*/ 
	public static function store(Request $request)
	{
		if (is_object($request)) {
			
			$validation = $request->validate([
				'title' => 'required|min:15|max:120',
				'description' => 'required|min:120|max:1000',
				'image' => 'image',
			]);

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
	* @param \Illuminate\Http\Request $request
	* @param $id int
	*
	* @return updated article
	*/ 
	public static function updateArticles(Request $request, $id)
	{
		if (is_object($request)) {

			$validation = $request->validate([
				'title' => 'required|min:15|max:120',
				'description' => 'required|min:120|max:1000',
				'image' => 'image',
			]);

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
	public static function deleteArticles($id)
	{
		return Article::where('id', $id)->delete();
	}
}
