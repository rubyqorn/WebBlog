<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Http\Requests\StoreRecords;
use App\DiscussionCategory;
use App\Discussion;

class DiscussionsController extends Controller
{
    /**
    * @var object App\Discussion
    */ 
    private $discussion;

    public function __construct()
    {
        $this->discussion = new Discussion();
        $this->category = new DiscussionCategory();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (view()->exists('templates.admin.discussions')) {
            $chart = CountRecordsForCharts::chart($this->discussion);
            $discussions = $this->discussion->getDiscussionsForTable();
            $categories = $this->category->getCategories();

            return view('templates.admin.discussions')->with([
                'chart' => $chart,
                'discussions' => $discussions,
                'categories' => $categories,
            ]);
        }

        abort(404);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecords  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecords $request)
    {
        if ($request->isMethod('post')) {
            $this->discussion->storeQuestions($request);

            return redirect()->back()->withStatus('Your discussion was created successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecords  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRecords $request, $id)
    {
        if ($request->isMethod('patch')) {
            $this->discussion->updateDiscussions($request, $id);

            return redirect()->back()->withStatus('Record was updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $this->discussion->deleteDiscussions($id);

            return redirect()->back()->withStatus('Discussion was deleted successfully');
        }
    }
}
