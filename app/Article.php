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
	 * Get a relationships with ArticleCategory 
	 */ 
	public function category()
	{
		return $this->belongsTo(ArticleCategory::class, 'category_id', 'category_id');
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
	* @param $request object App\Http\Requests\StoreRecords
	*
	* @return bool
	*/ 
	public static function store($request)
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
	public static function updateArticles($request, $id)
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
	public static function deleteArticles($id)
	{
		return Article::where('id', $id)->delete();
	}
}
