<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DiscussionCategory;
use App\Discussion;

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

    protected function getCategoryId(string $category)
    {
        return DiscussionCategory::select('category_id')
            ->where('name', $category)
            ->get();
    }

    protected function storeDiscussionsWithFile(Request $request, string $categoryId, array $validatedFields)
    {
        $image = $request->file('file');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put(
            $image->getFileName() . $extension, File::get($image)
        );

        return Discussion::create([
            'category_id' => $categoryId,
            'user_id' => \Auth::user()->id,
            'title' => $validatedFields['title'],
            'description' => $validatedFields['question'],
            'image' => $image->getFileName() . '.' . $extension
        ]);
    }

    protected function storeDiscussionsWithoutFile(string $categoryId, array $validatedFields)
    {
        return Discussion::create([
            'category_id' => $categoryId,
            'user_id' => \Auth::user()->id,
            'title' => $validatedFields['title'],
            'description' => $validatedFields['question']
        ]);
    }

    public function askQuestion(Request $request)
    {
        $discussionsData = $request->validate([
            'title' => 'required|min:3|max:120',
            'question' => 'required|min:120',
            'categories' => 'required',
            'file' => 'nullable|image'
        ]);

        $categoryId = $this->getCategoryId($request->categories)['0']['category_id'];

        if ($request->hasFile('file')) {
            $this->storeDiscussionsWithFile($request, $categoryId, $discussionsData);
            return response()->json([
                'status' => '200',
                'message' => 'Вопрос задан, ожидайте ответа)'
            ]);
        }

        $this->storeDiscussionsWithoutFile($categoryId, $discussionsData);
        return response()->json([
            'status_code' => '200',
            'message' => 'Вопрос задан, ожидайте ответа)'
        ]);
    }
    
}
