<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	/**
	* @return Relationships with App\DiscussionCategory
	*/ 
    public function categories()
    {
    	return $this->hasMany(DiscussionCategory::class, 'category_id');
    }

    /**
    * @return Relationships with App\Answer
    */ 
    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }
}
