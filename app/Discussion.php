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

    /**
    * Select discussions with pagination 
    *
    * @return discussions
    */ 
    public function getDiscussions()
    {
        return Discussion::join('discussions_categories', 'discussions.category_id', 'discussions.category_id')->paginate(5);
    }
}
