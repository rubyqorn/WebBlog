<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * Get relationships with App\User model
     */ 
    public function user()
    {
        return Answer::belongsTo(User::class);
    }

    /**
    * @return records for chart
    */ 
    public function getRecordsByMonth($month)
    {
        return Answer::whereMonth('created_at', $month)->count();
    }


     /**
    * Validate forms fields and create new record in
    * database
    *
    * @param \Illuminate\Http\Request $request
    *
    * @return created record in database or error messages
    * if passed fields was not validated
    */ 
    public static function store(Request $request)
    {
        if (is_object($request)) {

            $validation = $request->validate([
                'response' => 'required|min:5|max:1000'
            ]);

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
    * @param \Illuminate\Http\Request $request
    * @param $id int
    * 
    * @return \Illuminate\Http\Response
    */ 
    public static function updateAnswer(Request $request, $id)
    {
        if (is_object($request)) {
            
            $validation = $request->validate([
                'response' => 'required|min:5|max:1000'
            ]);

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
    public static function deleteAnswer($id)
    {
        return Answer::where('id', $id)->delete();
    }
}
