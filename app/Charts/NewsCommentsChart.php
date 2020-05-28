<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\NewsComment;

class NewsCommentsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getNewsCommentsByMonth(string $month)
    {
        return NewsComment::whereMonth('created_at', $month)->count();
    }

    protected function countNewsComments()
    {
        return [
            $this->getNewsCommentsByMonth('01'),
            $this->getNewsCommentsByMonth('02'),
            $this->getNewsCommentsByMonth('03'),
            $this->getNewsCommentsByMonth('04'),
            $this->getNewsCommentsByMonth('05'),
            $this->getNewsCommentsByMonth('06'),
            $this->getNewsCommentsByMonth('07'),
            $this->getNewsCommentsByMonth('08'),
            $this->getNewsCommentsByMonth('09'),
            $this->getNewsCommentsByMonth('10'),
            $this->getNewsCommentsByMonth('11'),
            $this->getNewsCommentsByMonth('12'),
        ];
    }

    public function create()
    {
        $comments = $this->countNewsComments();

        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);

        $dataset = $this->dataset(
            'Статистика комментариев к новостям по месяцам',
            'pie', $comments
        );
        $dataset->backgroundColor([
            '#6b5b95', '#feb236', '#d64161','#ff7b25','#eca1a6','#ff6f69',
            '#ffcc5c','#588c7e','#5b9aa0','#667292','#87bdd8','#ffef96',
        ]);

        return $this;
    }
}
