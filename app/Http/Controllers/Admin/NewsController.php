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

    public function selectedPostForEdit($id)
    {
        return News::with('category')->where('id', $id)->get();
    }

    public function edit($id) 
    {
        if (!view()->exists('dashboard.edit-news')) {
            return abort(404);
        }

        return view('dashboard.edit-news')
            ->withTitle('Edit news')
            ->withCategories(NewsCategory::all());
    }

    public function update(Request $request)
    {
        $newsData = $request->validate([
            'title' => 'required|min:10|max:80',
            'description' => 'required|min:120',
            'category' => 'required'
        ]);

        $news = News::findOrFail($request->id);
        $news->category_id = $request->category;
        $news->user_id = \Auth::user()->id;
        $news->title = $newsData['title'];
        $news->description = $newsData['description'];
        $news->save();

        return response()->json([
            'status' => '200',
            'message' => "Post with id {$request->id} was updated"
        ]);
    }

    public function delete($id)
    {
        News::where('id', $id)->delete();

        return response()->json([
            'status' => '200',
            'message' => "Post with {$id} id was deleted!"
        ]);
    }
}
