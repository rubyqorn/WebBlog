<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DiscussionCategory extends Model
{
    protected $table = 'discussions_categories';
    protected $fillable = ['name', 'color'];
    protected $primaryKey = 'category_id';

    public function discussion()
    {
    	return $this->belongsTo(Discussion::class);
    } 

   /**
    * Delete discussions categories by id property
    *
    * @param $id int
    * 
    * @return \App\DiscussionCategory
    */
   public function deleteCategories($id)
   {
       return DiscussionCategory::where('category_id', $id)->delete();
   }
}
