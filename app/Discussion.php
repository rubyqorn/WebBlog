<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use Http\Traits\CheckFile;

    protected $fillable = [
        'description','title', 'image', 'category_id'
    ];

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

    /**
    * Get fields for validation and create new record
    * in database
    *
    * @param $request object Illuminate\Http\Request
    *
    * @return created record in database
    */ 
    public function storeQuestions(object $request)
    {
        // Fields validation
        $messages = [
            'required' => ':attribute поле должно быть обязательно заполнено',
            'min' => ':attribute поле должно содержать не меньше :min символов',
            'max' => ':attribute поле должно содержать не юольше :max символов',
            'image' => 'переданный файл должен быть в формате jpeg, png, bmp, gif, svg, или webp',
        ];

        $validation = $request->validate([
            'title' => 'required|min:15|max:30',
            'description' => 'min:120|max:400',
            'image' => 'image',
            'categories' => 'required',
        ], $messages);

        // Check file containing
        $filename = Http\Traits\CheckFile::checkForFileContains($request, 'image');

        // Create record in database
        return Discussion::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->categories,
            'image' => $filename
        ]);
        
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
    * Get discussions with pagination for admin 
    * part of app
    *
    * @return paginated discussions
    */ 
    public function getDiscussionsForTable()
    {
        return Discussion::paginate(5);
    }
}
