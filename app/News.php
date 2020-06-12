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
}
