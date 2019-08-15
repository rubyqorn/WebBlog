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
}
