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
}
