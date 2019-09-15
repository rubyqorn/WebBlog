<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionCategory extends Model
{
    protected $table = 'discussions_categories';
    protected $fillable = ['name'];

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

    /**
     * Store discussions categories
     * 
     * @param \App\Http\Requests\StoreCategories
     * 
     * @return \App\DiscussionCategory 
    */ 
   public function storeCategories($request)
   {
       if (is_object($request)) {
           $validation = $request->validated();

           return DiscussionCategory::create([
               'name' => $request->category
           ]);
       }
   }

   /**
    * Update discussions categories by id property
    *
    * @param \App\Http\Requests\StoreCategories $request
    * @param $id int
    * @return \App\DiscussionCategory
    */
   public function updateCategories($request, $id)
   {
       if (is_object($request)) {

           $validation = $request->validated();

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
