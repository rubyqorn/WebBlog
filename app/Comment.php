<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
}
