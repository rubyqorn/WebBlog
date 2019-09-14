<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionCategory extends Model
{
    protected $table = 'discussions_categories';

    /**
    * @return inverse relationships with App\Discussion
    */ 
    public function discussion()
    {
    	return $this->belongsTo(Discussion::class);
    } 

    /**
    * Get categories for sidebar section in discussions page
    *
    * @return categories
    */ 
    public function getCategories()
    {
    	return DiscussionCategory::all();
    }

    /**
    * Get categories for AJAX request
    *
    * @return mixed
    */ 
    public function getCategoriesForTable()
    {
        return DiscussionCategory::paginate(5);
    }
}
