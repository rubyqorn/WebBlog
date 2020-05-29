<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CheckFile;
use Illuminate\Http\Request;

class Discussion extends Model
{
    protected $fillable = [
        'description','title', 'image', 'category_id', 
        'user_id'
    ];

    public function category()
    {
    	return $this->belongsTo(DiscussionCategory::class, 'category_id', 'category_id');
    }

    public function answers()
    {
    	return $this->belongsTo(Answer::class, 'id', 'discussion_id');
    }

    public function authors()
    {
        return $this->belongsTo(User::class, 'user_id');
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
