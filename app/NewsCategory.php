<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
	protected $table = 'news_categories';

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
     * @return mixed
     */
    public function getCategoriesForTable()
    {
        return NewsCategory::paginate(5);
    }

    /**
     * Update categories by id property
     *
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     * @return mixed
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
     * Delete categories by id property
     *
     * @param $id int
     * @return mixed
     */
    public function deleteCategories($id)
    {
        return NewsCategory::where('category_id', $id)->delete();
    }

}
