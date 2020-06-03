<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\NewsItemsChart;
use App\NewsCategory;
use App\News;

class NewsController extends Controller
{
    public function showPage()
    {
        if (!view()->exists('dashboard.news')) {
            abort(404);
        }

        $chart = new NewsItemsChart();
        $chart = $chart->create();

        return view('dashboard.news')->withTitle('News')
            ->withChart($chart);
    }

    public function search(Request $request)
    {
        return News::with('category')
            ->withCount('comments')
            ->where('title', 'like', '%' . $request->title . '%')
            ->orderByDesc('created_at')
            ->paginate(5);
    }

    public function create() 
    {
        if (!view()->exists('dashboard.create-news')) {
            abort(404);
        }

        return view('dashboard.create-news')
            ->withTitle('Create news')
            ->withCategories(NewsCategory::all());
    }

    protected function getCategoryIdByName(string $name)
    {
        return NewsCategory::select('category_id')
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public function store(Request $request) 
    {
        $newsData = $request->validate([
            'title' => 'required|min:10|max:80',
            'description' => 'required|min:120',
            'file' => 'required|image'
        ]);

        $image = $request->file('file');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put(
            $image->getFileName() . '.' . $extension, File::get($image)
        );

        $categoryId = $this->getCategoryIdByName($request->category)['0']['category_id'];
        News::create([
            'category_id' => $categoryId,
            'user_id' => \Auth::user()->id,
            'title' => $newsData['title'],
            'description' => $newsData['description'],
            'image' => $image->getFileName() . '.' . $extension
        ]);

        return response()->json([
            'status_code' => '200',
            'message' => 'Post created!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $updating = News::updateRecords($request, $id); 

            if ($updating) {
                return redirect()->route('news.index')->withStatus('Record was updated successfully'); 
            }

            abort(404);
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete')) {
            $deletion = News::deleteNews($id);

            if($deletion) {
                return redirect()->route('news.index')->withStatus('Record was deleted successfully');
            }

        }
    }
}
