<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CheckFile;

class News extends Model
{
	protected $fillable = [
		'title', 'preview_text', 'description', 'image',
		'category_id'
	];

	protected $table = 'news';

	/**
	* Get a relationship with NewsCategory
	*/ 
	public function category()
	{
		return $this->belongsTo(NewsCategory::class, 'category_id', 'category_id');
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
	 * @param \Illuminate\Http\Request
	 *  
	 * @return \App\News
	*/ 
	public static function searchNews($request)
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
	* @param $request object App\Http\Requests\StoreNews
	*
	* @return bool
	*/ 
	public function store($request)
	{	
		if (is_object($request)) {
			$validation = $request->validated();

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
	* @param \App\Http\Requests\StoreNews $request
	* @param $id int
	*
	* @return updated record
	*/ 
	public function updateRecords($request, $id)
	{
		if (is_object($request)) {
			
			$validation = $request->validated();

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
	public function deleteNews($id)
	{
		return News::where('id', $id)->delete();
	}

}
