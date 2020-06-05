<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DiscussionCategory extends Model
{
    protected $table = 'discussions_categories';
    protected $fillable = ['name', 'color'];

    public function discussion()
    {
    	return $this->belongsTo(Discussion::class);
    } 

   /**
    * Update discussions categories by id property
    *
    * @param \Illuminate\Http\Request $request
    * @param $id int
    * @return \App\DiscussionCategory
    */
   public function updateCategories(Request $request, $id)
   {
       if (is_object($request)) {

           $validation = $request->validate([
               'name' => 'required|min:5|max:20'
           ]);

           return DiscussionCategory::where('category_id', $id)->update([
               'name' => $request->category
           ]);

       }
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
