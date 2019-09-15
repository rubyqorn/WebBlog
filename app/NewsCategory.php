<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'news_categories';
    protected $fillable = ['name'];

	/**
	* @return inverse relationships with App\News
	*/
	public function news()
	{
		return $this->belongsTo(News::class);
	}

    /**
    * Get all categories from database
    *
    * @return records from database by created_at column
    */
    public function getCategories()
    {
    	return $this->select('category_id', 'name')->orderBy('created_at', 'desc')->get();
    }


    /**
     *  Get categories for table
     *
     * @return \App\NewsCategory
     */
    public function getCategoriesForTable()
    {
        return NewsCategory::paginate(5);
    }

    /**
     * Store news categories
     * 
     * @param \App\Http\Requests\StoreCategories
     * 
     * @return \App\NewsCategory 
    */ 
    public function storeCategories($request)
    {
        if (is_object($request)) {
            $validation = $request->validated();

            return NewsCategory::create([
                'name' => $request->category
            ]);
        }
    }

    /**
     * Update news categories by id property
     *
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     * @return \App\NewsCategory
     */
    public function updateCategories($request, $id)
    {
        if (is_object($request)) {

            $validation = $request->validated();

            return NewsCategory::where('category_id', $id)->update([
                'name' => $request->category
            ]);

        }
    }

    /**
     * Delete news categories by id property
     *
     * @param $id int
     * 
     * @return \App\NewsCategory
     */
    public function deleteCategories($id)
    {
        return NewsCategory::where('category_id', $id)->delete();
    }

}
