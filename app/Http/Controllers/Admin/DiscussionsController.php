<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\DiscussionsItemsChart;
use App\DiscussionCategory;
use App\Discussion;

class DiscussionsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.discussions')) {
            abort(404);
        }

        $chart = new DiscussionsItemsChart();
        $chart = $chart->create();

        return view('dashboard.discussions')
            ->withTitle('Discussions')
            ->withChart($chart);
    }

    public function search(Request $request)
    {
        return Discussion::with('category')
            ->with('authors')
            ->withCount('answers')
            ->where('title', 'like', '%' . $request->title . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create()
    {
        if (!view()->exists('dashboard.create-discussions')) {
            return abort(404);
        }

        return view('dashboard.create-discussions')
            ->withTitle('Create Discussions')
            ->withCategories(DiscussionCategory::all());
    }

    protected function getCategoryIdByName(string $name)
    {
       return DiscussionCategory::select('category_id')
        ->where('name', 'like', '%' . $name . '%')
        ->get(); 
    }

    protected function storeDiscussionsWithFile(Request $request, string $categoryId, array $validatedFields)
    {
        $image = $request->file('file');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put(
            $image->getFileName() . '.' . $extension, File::get($image)
        );

        return Discussion::create([
            'category_id' => $categoryId,
            'user_id' => \Auth::user()->id,
            'title' => $validatedFields['title'],
            'description' => $validatedFields['description'],
            'image' => $image->getFileName() . '.' . $extension
        ]);
    }

    protected function storeDiscussionsWithoutFile(string $categoryId, array $validatedFields)
    {
        return Discussion::create([
            'category_id' => $categoryId,
            'user_id' => \Auth::user()->id,
            'title' => $validatedFields['title'],
            'description' => $validatedFields['description']
        ]);
    }
    
    public function store(Request $request)
    {
        $discussionsData = $request->validate([
            'title' => 'required|min:10|max:120',
            'description' => 'required|min:120',
            'category' => 'required',
            'file' => 'nullable|image'
        ]);
        $categoryId = $this->getCategoryIdByName($request->category)['0']['category_id'];

        if ($request->hasFile('file')) {
            $this->storeDiscussionsWithFile($request, $categoryId, $discussionsData);
            return response()->json([
                'status_code' => '200',
                'message' => 'Discussion created!'
            ]);
        }

        $this->storeDiscussionsWithoutFile($categoryId, $discussionsData);
        return response()->json([
            'status_code' => '200',
            'message' => 'Discussion created!'
        ]);
    }

    public function selectedDiscussion($id)
    {
        return Discussion::with('category')
            ->with('authors')
            ->withCount('answers')
            ->where('id', $id)
            ->get();
    }

    public function edit()
    {
        if (!view()->exists('dashboard.edit-discussions')) {
            return abort(404);
        }

        return view('dashboard.edit-discussions')
            ->withTitle('Edit Discussion')
            ->withCategories(DiscussionCategory::all());
    }

    protected function updateWithFile(Request $request, Discussion $discussion)
    {
        $discussionsData = $request->validate([
            'title' => 'required|min:10|max:120',
            'description' => 'required|min:120',
            'category' => 'required',
            'image' => 'nullable|image'
        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();

        Storage::disk('public')->put(
            $image->getFileName() . '.' . $extension, File::get($image)
        );

        $discussion->title = $discussionsData['title'];
        $discussion->description = $discussionsData['description'];
        $discussion->image = $image->getFileName() . '.' . $extension;
        $discussion->category_id = $discussionsData['category'];
        return $discussion->save();
    }

    protected function updateWithoutFile(Request $request, Discussion $discussion)
    {
        $discussionsData = $request->validate([
            'title' => 'required|min:10|max:120',
            'description' => 'required|min:120',
            'category' => 'required',
        ]);

        $discussion->title = $discussionsData['title'];
        $discussion->description = $discussionsData['description'];
        $discussion->category_id = $discussionsData['category'];
        return $discussion->save();
    }

    public function update(Request $request)
    {
        $discussion = Discussion::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $this->updateWithFile($request, $discussion);
            return response()->json([
                'status' => '200',
                'message' => "Discussion with {$request->id} id was updated!"
            ]);       
        }

        $this->updateWithoutFile($request, $discussion);
        return response()->json([
            'status' => '200',
            'message' => "Discussion with {$request->id} was updated!"
        ]);
    }

    public function delete($id)
    {
        Discussion::where('id', $id)->delete();

        return response()->json([
            'status' => '200', 
            'message' => "Discussion with {$id} id was deleted!"
        ]);
    }
}
