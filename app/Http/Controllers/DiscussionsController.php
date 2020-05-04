<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscussionCategory;
use App\Discussion;
use App\Answer;

class DiscussionsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
    */
    public function showPage()
    {
    	$discussions = Discussion::withCount('answers')->paginate(5);
        $categories = DiscussionCategory::orderBy('created_at', 'DESC')->get();

        if (view()->exists('discussions')) {
        	return view('discussions')->with([
        		'discussions' => $discussions,
        		'categories' => $categories
        	]);
        }

        abort(404); 
    }

    /**
     * @return void
     */ 
    public function discussions()
    {
        return Discussion::with('category')
                ->with('authors')
                ->withCount('answers')
                ->paginate(10);
    }

    /**
    * Show single discussion page where contains 
    * answers discussion content and latest discussions
    * 
    * @param $id int Get discussion id which we wanna to look
    *
    * @return single discussion page
    */ 
    public function showSingleDiscussion($id)
    {

    	$discussion = Discussion::findOrFail($id);
    	$answers = Answer::where('discussion_id', $id)->paginate(3);
        $latestDiscussions = Discussion::latest()->limit(5)->get();

    	if (view()->exists('templates.discussion')) {
    		return view('templates.discussion')->with([
    			'discussion' => $discussion,
    			'answers' => $answers,
    			'latestDiscussions' => $latestDiscussions
    		]);
    	}

    	abort(404);
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

    /**
     * Search discussions by search content
     * 
     * @param \Illuminate\Http\Request
     *  
     * @return \Illuminate\Http\Response
     */ 
    public function search(Request $request)
    {
        $discussions = Discussion::searchDiscussions($request);
    
        return view('templates.search-content', compact('discussions'));
    }
}
