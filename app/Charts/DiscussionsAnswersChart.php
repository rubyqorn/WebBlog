<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Answer;

class DiscussionsAnswersChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getAnswersByMonth(string $month)
    {
        return Answer::whereMonth('created_at', $month)
            ->count();
    }

    protected function countAnswersByMonth()
    {
        return [
            $this->getAnswersByMonth('01'),
            $this->getAnswersByMonth('02'),
            $this->getAnswersByMonth('03'),
            $this->getAnswersByMonth('04'),
            $this->getAnswersByMonth('05'),
            $this->getAnswersByMonth('06'),
            $this->getAnswersByMonth('07'),
            $this->getAnswersByMonth('08'),
            $this->getAnswersByMonth('09'),
            $this->getAnswersByMonth('10'),
            $this->getAnswersByMonth('11'),
            $this->getAnswersByMonth('12')
        ];
    }

    public function create()
    {
        $answers = $this->countAnswersByMonth();

        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);

        $dataset = $this->dataset(
            'Статистика ответ к обсуждениям по месяцам',
            'pie', $answers
        );
        $dataset->backgroundColor([
            '#6b5b95', '#feb236', '#d64161','#ff7b25','#eca1a6','#ff6f69',
            '#ffcc5c','#588c7e','#5b9aa0','#667292','#87bdd8','#ffef96',
        ]);

        return $this;
    }
}
