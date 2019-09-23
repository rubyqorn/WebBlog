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

	/**
	* Select news by category with pagination
	*
	* @param $id int
	*
	* @return records with pagination
	*/ 
	public function newsByCategory($id)
	{
		return News::where('category_id', $id)->paginate(5);
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
	public function searchNews($request)
	{
		if (is_object($request)) {
			return News::where('title', $request->search)
						->orWhere('title', 'like', '%' . $request->search . '%')
						->get();
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
