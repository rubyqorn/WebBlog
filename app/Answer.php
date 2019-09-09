<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreResponses;

class Answer extends Model
{
    protected $fillable = [
        'user_id', 'answer', 'discussion_id'
    ];

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

    /**
    * Return quantity of answers
    */ 
    public function countedAnswers()
    {
        return Answer::count();
    }

    /**
    * @return three last answers
    */ 
    public function getLastAnswers()
    {
        return Answer::orderBy('created_at', 'desc')->limit(3)->get();
    }

    /**
    * @return records for chart
    */ 
    public function getRecordsByMonth($month)
    {
        return Answer::whereMonth('created_at', $month)->count();
    }

    /**
    * Get answers for table in admin table
    *
    * @return paginated records 
    */ 
    public function getAnswersForTable()
    {
        return Answer::paginate(5);
    }

     /**
    * Validate forms fields and create new record in
    * database
    *
    * @param $request object App\Http\StoreResponses 
    *
    * @return created record in database or error messages
    * if passed fields was not validated
    */ 
    public function store($request)
    {
        if (is_object($request)) {

            $validation = $request->validated();

            return Answer::create([
                'user_id' => Auth::user()->id,
                'discussion_id' => $request->id,
                'answer' => $request->response
            ]);
        }
    }

    /**
    * Update answer by id property
    *
    * @param \App\Http\Requests\StoreResponses $request
    * @param $id int
    * 
    * @return \Illuminate\Http\Response
    */ 
    public function updateAnswer($request, $id)
    {
        if (is_object($request)) {
            
            $validation = $request->validated();

            return Answer::where('id', $id)->update([
                'answer' => $request->response
            ]);

        }
    }

    /**
    * Delete answers by id property
    *
    * @param $id int
    *
    * @return \Illuminate\Http\Response
    */ 
    public function deleteAnswer($id)
    {
        return Answer::where('id', $id)->delete();
    }
}
