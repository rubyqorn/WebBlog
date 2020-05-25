<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Answer;

class UsersAnswersActivity extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getTodayAnswersNumber()
    {
        return Answer::where('created_at', 'like', '%' . '2020-05-20' . '%')
            ->count();
    }

    protected function getYesterdayAnswersNumber()
    {
        $dateStr = date('Y-m-d', strtotime('-1 days'));
        
        return Answer::where('created_at', 'like', '%' . $dateStr . '%')
            ->count();
    }

    public function create()
    {
        $todayCommentsNumber = $this->getTodayAnswersNumber();
        $yesterdayCommentsNumber = $this->getYesterdayAnswersNumber();

        $this->labels([date('d M', strtotime('-1 days')), date('d M')]);
        $dataset = $this->dataset(
            'Статистика по ответам на дискуссии за сегодняшний день',
            'pie', [$yesterdayCommentsNumber,$todayCommentsNumber]
        );
        $dataset->backgroundColor([
            '#ff6f69','#ffcc5c'
        ]);

        return $this;
    }
}
