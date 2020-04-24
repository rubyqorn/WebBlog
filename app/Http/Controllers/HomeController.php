<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UsersCommentsActivity;
use App\Charts\UsersAnswersActivity;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function index()
    {
        $commentsChart = new UsersCommentsActivity();
        $answersChart = new UsersAnswersActivity();
        $commentsChart = $commentsChart->create();
        $answersChart = $answersChart->create();

        return view('home')->withTitle('Dashboard')
            ->withCommentsChart($commentsChart)
            ->withAnswersChart($answersChart);
    }

    public function users()
    {
        return User::with('roles')->orderByDesc('created_at')  
            ->paginate(10);
    }
}
