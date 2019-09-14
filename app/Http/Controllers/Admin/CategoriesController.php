<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArticleCategory;
use App\NewsCategory;
use App\DiscussionCategory;

class CategoriesController extends Controller
{
    /**
     * @var \App\ArticleCategory  
    */ 
    protected $articleCategory;

    /**
     * @var \App\NewsCategory
    */ 
    protected $newsCategory;

    /**
     * @var \App\DiscussionCategory 
    */ 
    protected $discussionCategory;

    public function __construct()
    {
        $this->articleCategory = new ArticleCategory();
        $this->newsCategory = new NewsCategory();
        $this->discussionCategory = new DiscussionCategory();
    }

	/**
	* Get page with categories table
	*
	* @return categories table
	*/
    public function showPage()
    {
        return view('templates.admin.categories');
    }

    /**
    * Store categories
    *
    * @param \App\Http\Requests\StoreCategories
    *
    * @return \Illuminate\Http\Response
    */ 
    public function store($request, $model)
    {   
        if ($request->isMethod('post')) {
           $model->storeCategories($request);

            return redirect()->back()->withStatus('Category was added successfully');
        }

    }

    /**
     * Update categories by id property
     *
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function update($request, $model, $id)
    {
        if ($request->isMethod('put')) {
            $model->updateCategories($request, $id);

            return redirect()->back()->withStatus('Category was updated successfully');
        }

    }

    /**
     * Delete categories by id property
     *
     * @param \App\Http\Requests\StoreCategories $request
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($request, $model, $id)
    {
        if ($request->isMethod('put')) {
            $model->deleteCategories($id);

            return redirect()->back()->withStatus('Category was deleted successfully');
        }
    }

}
