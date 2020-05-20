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

        return view('single-discussion')->withDiscussion($discussion);
    }

    public function answers($id)
    {
        return Answer::orderByDesc('created_at')->where('discussion_id', $id)
                ->with('user')
                ->get();
    }

    public function lastDiscussions()
    {   
        return Discussion::orderByDesc('created_at')->take(5)->get();
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

    public function storeAnswers(Request $request, $id)
    {
        if (!$request->isMethod('POST')) {
            return abort(404);
        }

        $data = $request->validate([
            'answer' => 'required|min:3|max:700'
        ]);

        $answer = Answer::create([
            'user_id' => \Auth::user()->id,
            'discussion_id' => $id,
            'answer' => $data['answer']
        ]);

        return redirect()->back()->withStatus('Ответ оставлен');
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
