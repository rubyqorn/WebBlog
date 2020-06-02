<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CheckFile;
use Illuminate\Http\Request;

class News extends Model
{
	protected $fillable = [
		'title', 'preview_text', 'description', 'image',
		'category_id', 'user_id'
	];

	protected $table = 'news';

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	
	public function category()
	{
		return $this->belongsTo(NewsCategory::class, 'category_id', 'category_id');
	}

	public function comments()
	{
		return $this->belongsTo(NewsComment::class, 'id', 'news_id');
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
		return News::whereMonth('created_at', $month)->count();
	}

	/**
	 * Search news
	 * 
	 * @param \Illuminate\Http\Request $request
	 *  
	 * @return \App\News
	*/ 
	public static function searchNews(Request $request)
	{
		if (is_object($request)) {
			return News::where('title', $request->search)
						->orWhere('title', 'like', '%' . $request->search . '%')
						->paginate(5);
		}
	}

	/**
	* Store new records in database
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
				'category' => 'required',
			]);

			$filename = CheckFile::checkForFileContains($request, 'image');

			return News::create([
				'title' => $request->title,
				'preview_text' => $request->preview_text,
				'description' => $request->description,
				'image' => $filename,
				'category_id' => $request->category
			]);
		}
	} 

	/**
	* Update news by id property
	*
	* @param \Illuminate\Http\Request $request
	* @param $id int
	*
	* @return updated record
	*/ 
	public static function updateRecords(Request $request, $id)
	{
		if (is_object($request)) {
			
			$validation = $request->validate([
				'title' => 'required|min:15|max:120',
				'preview_text' => 'required|min:10|max:500',
				'description' => 'required|min:120|max:1000',
				'image' => 'image',
				'category' => 'required',
			]);

			$filename = CheckFile::checkForFileContains($request, 'image');

			return News::where('id', $id)->update([
				'title' => $request->title,
				'preview_text' => $request->preview_text,
				'description' => $request->description,
				'image' => $filename,
				'category_id' => $request->category
			]);

		}
	}

	/**
	* Delete news by id property
	*
	* @param $id int
	*
	* @return bool
	*/ 
	public static function deleteNews($id)
	{
		return News::where('id', $id)->delete();
	}

}
