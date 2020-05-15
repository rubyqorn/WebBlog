<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DiscussionCategory;
use App\Discussion;
use App\Answer;

class DiscussionsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('discussions')) {
            abort(404);
        }

        $categories = DiscussionCategory::orderBy('created_at', 'DESC')->get();

        return view('discussions')->withCategories($categories); 
    }

    public function discussions()
    {
        return Discussion::with('category')
                ->with('authors')
                ->withCount('answers')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
    }

    public function discussionsByCategory($id) 
    {
        if (!view()->exists('discussions-by-category')) {
            return abort(404);
        }

        $discussions = Discussion::orderBy('created_at', 'DESC')
            ->where('category_id', $id)
            ->with('category')
            ->with('answers')
            ->with('authors')
            ->get();
        $categories = DiscussionCategory::orderBy('created_at', 'DESC')->get();

        return view('discussions-by-category')->with([
            'discussions' => $discussions,
            'categories' => $categories
        ]);
    }

    public function discussionById($id)
    {
        if (!view()->exists('single-discussion')) {
            return abort(404);
        }

        $discussion = Discussion::where('id', $id)->with('authors')
            ->with('category')
            ->get();
        $answers = Answer::where('discussion_id', $id)->with('user')->get();
        $lastDiscussions = Discussion::orderBy('created_at', 'DESC')->take(5)->get();
        
        return view('single-discussion')->withDiscussion($discussion)
            ->withAnswers($answers)
            ->withLastDiscussions($lastDiscussions);
    }

    public function search(Request $request)
    {
        if ($request->category == null) {
            return Discussion::where('title', 'like', '%'. $request->searching .'%')->get();
        }

        $categoryId = DiscussionCategory::select('category_id')
            ->where('name', $request->category)
            ->get();
        $discussionsWithCategory = DB::table('discussions')
            ->whereRaw(
                "title = '{$request->searching}' and
                category_id = {$categoryId['0']->category_id}"
            )
            ->get();
        
        return $discussionsWithCategory;
    }

    /**
    * The method where we get fields for validation
    * and get redirect if validation and adding
    * new record was successfully
    *
    * @param $request object Illuninate\Http\Request
    * 
    * @return new added record in database
    */ 
    public function storeAnswers(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validation = Answer::store($request);

            return redirect()->back();
        }

        return abort(404);
        
    }

    /**
    * The method where we get fields for validation
    * and get redirect if validation and adding
    * new record was successfully
    *
    * @param $request object Illuninate\Http\Request
    * 
    * @return new added record in database
    */
    public function askQuestions(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validation = Discussion::storeQuestions($request);
            return redirect()->back()->with('status', 'Asked');
        }

        return abort(404);
        
    }
}
