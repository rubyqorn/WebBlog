<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleComment extends Model
{
	protected $table = 'articles_comments';

	protected $fillable = [
		'user_id', 'article_id', 'comment'
	];


	public function article()
	{
		return $this->belongsTo(Article::class, 'article_id');
	}

	public function users()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	/**
	* Get records for chart
	*
	* @param $month int|string
	*
	* @return records for chart
	*/ 
	public function getRecordsByMonth($month)
	{
		return Comment::whereMonth('created_at', $month)->count();
	}

	/**
	* Validate forms fields and create new record in
	* database
	*
	* @param $request object Illuminate\Http\Request 
	*
	* @return created record in database or error messages
	* if passed fields was not validated
	*/ 
	public static function store(Request $request)
	{
		if (!is_object($request)) {
			return abort(404);
		}

		$validation = $request->validate([
			'response' => 'required|min:5|max:1000'
		]);

		if ($validation) {
			return Comment::create([
				'user_id' => Auth::user()->id,
				'article_id' => $request->id,
				'comment' => $request->response,
			]);
		}
	}

		

	/**
	* Update comments by id property
	*
	* @param \Illuminate\Http\Request $request
	* @param $id int
	*
	* @return \Illuminate\Http\Response
	*/ 
	public static function updateComment(Request $request, $id)
	{
		if (is_object($request)) {
			$validation = $request->validate([
				'comment' => 'required|min:5|max:1000'
			]);

			return Comment::where('id', $id)->update([
				'comment' => $request->comment
			]);
		}
	}

	/**
	* Delete comments by id property
	*
	* @param $id int
	*
	* @return \Illuminate\Http\Response
	*/ 
	public static function deleteComment($id)
	{
		return Comment::where('id', $id)->delete();
	}

	/**
	 * Search comments
	 * 
	 * @param \Illuminate\Http\Request $request 
	 * 
	 * @return \Illuminate\Support\Collection
	 * */ 
	public static function searchComments(Request $request)
	{
		return Comment::where('comment', $request->search)
					->orWhere('comment', 'like', '%' . $request->search . '%')
					->paginate(5);
	}

}
