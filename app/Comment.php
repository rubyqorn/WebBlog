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
		return $this->belongsTo(Article::class);
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
	* Validate forms fields and create new record in
	* database
	*
	* @param $request object Illuminate\Http\Request 
	*
	* @return created record in database or error messages
	* if passed fields was not validated
	*/ 
	public function store(object $request)
	{
		$messages = [
			'required' => ':attribute должно быть обязательно заполнено',
			'min' => ':attribute должно содержать не меньше :min символов',
			'max' => ':attribute должно содержать не больше :max символов'
		];

		$validation = $request->validate([
			'response' => 'required|min:120|max:255'
		], $messages);

		return Comment::create([
			'user_id' => Auth::user()->id,
			'article_id' => $request->id,
			'comment' => $request->response,
		]);
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

}
