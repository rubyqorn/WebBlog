<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
            'min' => ':attribute должно иметь не меньше :min символов', 
            'max' => ':attribute должно иметь не больше :max символов' 
        ];

        $validation = $request->validate([
            'response' => 'required|min:120|max:255'
        ], $messages);

        return Answer::create([
            'user_id' => Auth::user()->id,
            'discussion_id' => $request->id,
            'answer' => $request->response
        ]);
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

    public function getAnswersForTable()
    {
        return Answer::paginate(5);
    }
}
