<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
	protected $fillable = [
		'user_id', 'article_id', 'comment'
	];

	/**
	* @return inverse relationships with App\Article
	*/ 
	public function article()
	{
		return $this->belongsTo(Article::class, 'article_id');
	}

	/**
	* Set has many relationship with App\User
	*
	* @return relationship with user model 
	*/ 
	public function users()
	{
		return $this->hasMany(User::class, 'id');
	}

	/**
	* Get comments with pagination for single article page
	*
	* @param $id int|string
	*
	* @return comments with pagination
	*/ 
	public function getComments($id)
	{
		return $this->join('articles', 'comments.article_id', 'articles.id')
					->join('users', 'comments.user_id', 'users.id')
					->where('article_id', $id)
					->paginate(3);
	}

	/**
	* Return quantity of comments
	*/ 
	public function countedComments()
	{
		return Comment::count();
	}

	/**
	* Get five last added comments
	*
	* @return last five records
	*/ 
	public function getLastComments()
	{
		return Comment::latest()->take(5)->get();
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
	* Get records for comments table
	*
	* @return records for table
	*
	*/ 
	public function getCommentsForTable()
	{
		return Comment::paginate(5);
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
	public function store($request)
	{
		if (!is_object($request)) {
			return abort(404);
		}

		$validation = $request->validate([
			'response' => 'required|min:5|max:120'
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
	* @param \App\Http\Requests\StoreResponses $request
	* @param $id int
	*
	* @return \Illuminate\Http\Response
	*/ 
	public function updateComment($request, $id)
	{
		if (is_object($request)) {
			$validation = $request->validated();

			return Comment::where('id', $id)->update([
				'comment' => $request->response
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
	public function deleteComment($id)
	{
		return Comment::where('id', $id)->delete();
	}

}
