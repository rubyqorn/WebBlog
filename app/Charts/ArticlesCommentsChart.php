<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\ArticleComment;

class ArticlesCommentsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getCommentsByMonth(string $month)
    {
        return ArticleComment::whereMonth('created_at', $month)->count();
    }

    protected function countCommentsByMonth()
    {
        return [
            $this->getCommentsByMonth('01'),
            $this->getCommentsByMonth('02'),
            $this->getCommentsByMonth('03'),
            $this->getCommentsByMonth('04'),
            $this->getCommentsByMonth('05'),
            $this->getCommentsByMonth('06'),
            $this->getCommentsByMonth('07'),
            $this->getCommentsByMonth('08'),
            $this->getCommentsByMonth('09'),
            $this->getCommentsByMonth('10'),
            $this->getCommentsByMonth('11'),
            $this->getCommentsByMonth('12')
        ];
    }

    public function create()
    {
        $comments = $this->countCommentsByMonth();

        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);

        $dataset = $this->dataset(
            'Статистика комментариев добавленных в определенном месяце',
            'pie', $comments
        );
        $dataset->backgroundColor([
            '#6b5b95', '#feb236', '#d64161','#ff7b25','#eca1a6','#ff6f69',
            '#ffcc5c','#588c7e','#5b9aa0','#667292','#87bdd8','#ffef96'
        ]);

        return $this;
    }
}
