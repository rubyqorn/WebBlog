<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	/**
	* @return inverse relationships with App\Discussion
	*/ 
    public function discussion()
    {
    	return $this->belongsTo(Discussion::class);
    }

    /**
    * Select answers for discussion with pagination
    *
    * @param $id int|string
    *
    * @return paginated discussion 
    */ 
    public function getAnswers($id)
    {
    	return Answer::join('discussions', 'answers.discussion_id', 'discussions.id')
    				->join('users', 'answers.user_id', 'users.id')
    				->where('discussion_id', $id)
    				->paginate(2);
    }
}
