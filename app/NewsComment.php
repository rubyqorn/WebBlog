<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $table = 'news_comments';

    public function news()
    {
        return $this->hasMany(News::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,  'id');
    }
}
