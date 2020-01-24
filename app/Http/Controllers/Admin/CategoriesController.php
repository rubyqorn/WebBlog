<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
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
    * @param \Illuminate\Http\Request $request 
    *
    * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request, $model)
    {   
        if ($request->isMethod('post')) {
           $model->storeCategories($request);
        }

    }

    /**
     * Update categories by id property
     *
     * @param \Illuminate\Http\Request $request
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $model, $id)
    {
        if ($request->isMethod('put')) {
            $model->updateCategories($request, $id);
        }

    }

    /**
     * Delete categories by id property
     *
     * @param \Illuminate\Http\Request $request
     * @param $id int
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $model, $id)
    {
        if ($request->isMethod('delete')) {
            $model->deleteCategories($id, $request);
        }
    }

}
