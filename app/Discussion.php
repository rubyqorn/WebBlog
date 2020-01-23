<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CheckFile;
use Illuminate\Http\Request;

class Discussion extends Model
{
    protected $fillable = [
        'description','title', 'image', 'category_id'
    ];

	/**
	* @return Relationships with App\DiscussionCategory
	*/ 
    public function category()
    {
    	return $this->belongsTo(DiscussionCategory::class, 'category_id', 'category_id');
    }

    /**
    * @return Relationships with App\Answer
    */ 
    public function answers()
    {
    	return $this->belongsTo(Answer::class, 'id', 'discussion_id');
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

    /**
    * Get and count records by month
    *
    * @param $month int|string Have to be like 01, 02...
    *
    * @return counted records by month
    */
    public function getRecordsByMonth($month)
    {
        return Discussion::whereMonth('created_at', $month)->count();
    }

    /**
    * Search discussions
    * 
    * @param \Illuminate\Http\Request $request 
    * 
    * @return \App\Discussion
    */ 
    public static function searchDiscussions(Request $request)
    {
        if (is_object($request)) {
            return Discussion::where('title', $request->search)
                            ->orWhere('title', 'like', '%'. $request->search .'%')
                            ->paginate(5);
        }
    }

    /**
    * Get fields for validation and create new record
    * in database
    *
    * @param \Illuminate\Http\Request $request 
    *
    * @return created record in database
    */ 
    public static function storeQuestions(Request $request)
    {
        if (is_object($request)) {
            
            $validation = $request->validate([
                'title' => 'required|min:15|max:40',
                'description' => 'max:300',
                'image' => 'image',
            ]);

            // Check file containing
            $filename = CheckFile::checkForFileContains($request, 'image');

            // Create record in database
            return Discussion::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category,
                'image' => $filename
            ]);

        }
    }

    /**
    * Update discussion by id property
    *
    * @param \Illuminate\Http\Request $request
    * @param $id int
    * 
    * @return updated record
    */ 
    public static function updateDiscussions(Request $request, $id)
    {
        if (is_object($request)) {

            $validation = $request->validate([
                'title' => 'required|min:15|max:40',
                'description' => 'max:300',
                'image' => 'image',
            ]);

            $filename = CheckFile::checkForFileContains($request, 'image');

            return Discussion::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category,
                'image' => $filename
            ]);
        }
    }

    /**
    * Delete discussions by id property
    *
    * @param $id int
    *
    * @return bool
    */ 
    public static function deleteDiscussions($id)
    {
        return Discussion::where('id', $id)->delete();
    }
}
