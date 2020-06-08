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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $updating = Discussion::updateDiscussions($request, $id);

            if($updating) {
                return redirect()->route('discussions.index')->withStatus('Record was updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $deletion = Discussion::deleteDiscussions($id);

            return redirect()->route('discussions.index')->withStatus('Discussion was deleted successfully');
        }
    }
}
