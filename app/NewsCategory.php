<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NewsCategory extends Model
{
    protected $table = 'news_categories';
    protected $fillable = ['name', 'color'];

	/**
	* @return inverse relationships with App\News
	*/
	public function news()
	{
		return $this->belongsTo(News::class);
	}

    /**
     * Store news categories
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \App\NewsCategory 
    */ 
    public function storeCategories(Request $request)
    {
        if (is_object($request)) {
            $validation = $request->validate([
                'name' => 'required|min:5|max:20'
            ]);

            return NewsCategory::create([
                'name' => $request->category
            ]);
        }
    }

    /**
     * Update news categories by id property
     *
     * @param \Illuminate\Http\Request $request
     * @param $id int
     * @return \App\NewsCategory
     */
    public function updateCategories(Request $request, $id)
    {
        if (is_object($request)) {

            $validation = $request->validate([
                'name' => 'required|min:5|max:20'
            ]);

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
