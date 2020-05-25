<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\NewsComment;
use App\ArticleComment;

class UsersCommentsActivity extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getTodayCommentsNumber()
    {   
        $newsComments = NewsComment::where('created_at', 'like', '%'. '2020-05-18' . '%')
            ->count();
        $articlesComments = ArticleComment::where('created_at', 'like', '%' . '2020-05-18' . '%')
            ->count();

        return $newsComments + $articlesComments;
    }

    protected function getYesterdayCommentsNumber()
    {
        $dateStr = date('Y-m-d', strtotime('-1 days'));

        $newsComments = NewsComment::where('created_at', 'like', '%' . $dateStr . '%')
            ->count();
        $articlesComments = ArticleComment::where('created_at', 'like', '%' . $dateStr . '%')
            ->count();
        
        return $newsComments + $articlesComments;
    } 

    public function create()
    {
        $todayCommentsNumber = $this->getTodayCommentsNumber();
        $yesterdayCommentsNumber = $this->getYesterdayCommentsNumber();

        $this->labels([date('d M', strtotime('-1 days')), date('d M')]);
        $dataset = $this->dataset(
            'Статистика за два последних дня',
            'line', [$yesterdayCommentsNumber, $todayCommentsNumber]
        );
        
        $dataset->color('#007bff');
        $dataset->backgroundColor('#d5f4e6');

        return $this;
    }
}
