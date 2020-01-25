<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CountRecordsForCharts;
use App\Article;
use App\Answer;
use App\Comment;
use App\User;
use App\News;

class DashboardController extends Controller
{
	/**
	* Show dashboard page
	*
	* @return \Illuminate\Http\Response
	*/ 
    public function showPage()
    {
        $newsChart = CountRecordsForCharts::chart(new News(), 'line', [
            'backgroundColor' => [
                '#4ddfb4',
            ],  
        ]);

        $usersChart = CountRecordsForCharts::chart(new User(), 'pie', [
            'backgroundColor' => [
                '#ffc107', '#dc3545', '#20c997',
                '#6f42c1', '#17a2b8', '#6c757d',
                '#28a745', '#e83e8c', '#6dd5e6',
                '#f0d480', '#c1a1f4', '#007bff'
            ]
        ]);

        $articlesChart = CountRecordsForCharts::chart(new Article(), 'line', [
            'borderColor' => 'blue',
            'backgroundColor' => 'transparent'
        ]);


        $countedAnswers = Answer::count();
        $countedComments = Comment::count();
        $countedUsers = User::count();
        $lastNews = News::orderBy('created_at', 'desc')->limit(5)->get();
        $lastComments = Comment::orderBy('created_at', 'desc')->limit(5)->get();
        $lastAnswers = Answer::orderBy('created_at', 'desc')->limit(5)->get();

    	if (view()->exists('templates.admin.dashboard')) {
    		return view('templates.admin.dashboard', compact(
                'countedAnswers', 'countedComments', 'countedUsers',
                'lastNews', 'lastComments', 'lastAnswers', 'newsChart',
                'usersChart', 'articlesChart'
            ));
    	}

    	abort(404);
    	
    }
}
