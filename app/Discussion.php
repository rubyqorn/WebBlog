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
    * Select discussions with counted answers and pagination
    *
    * @return discussions with pagination
    */ 
    public function getDiscussions()
    {
       return Discussion::withCount('answers')->paginate(5);
    }

    /**
    * Find discussion by id property
    *
    * @param $id int|string
    * 
    * @return single discussion
    */ 
    public function getDiscussionById($id)
    {
        return Discussion::findOrFail($id);
    }

    /**
    * Select five latest discussions from db
    *
    * @return five latest records
    */ 
    public function getLatestDiscussions()
    {
        return $this->latest()->take(5)->get();
    }

    /**
    * Get discussions by category id
    *
    * @param $id int Give articles by category_id field
    * 
    * @return discussions by category_id field in table
    */ 
    public function getDiscussionsById($id)
    {
        return Discussion::withCount('answers')->where('category_id', $id)
                        ->paginate(5);
    }
}
