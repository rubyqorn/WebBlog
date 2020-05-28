<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Article;

class ArticlesItemsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getArticlesItemsByMonth(string $month)
    {
        return Article::whereMonth('created_at', $month)->count();
    }

    protected function countArticlesByMonth()
    {
        return [
            $this->getArticlesItemsByMonth('01'),
            $this->getArticlesItemsByMonth('02'),
            $this->getArticlesItemsByMonth('03'),
            $this->getArticlesItemsByMonth('04'),
            $this->getArticlesItemsByMonth('05'),
            $this->getArticlesItemsByMonth('06'),
            $this->getArticlesItemsByMonth('07'),
            $this->getArticlesItemsByMonth('08'),
            $this->getArticlesItemsByMonth('09'),
            $this->getArticlesItemsByMonth('10'),
            $this->getArticlesItemsByMonth('11'),
            $this->getArticlesItemsByMonth('12')
        ];
    }

    public function create()
    {
        $articles = $this->countArticlesByMonth();

        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);

        $dataset = $this->dataset(
            'Статистика статей созданных в течении месяцев',
            'line', $articles
        );

        $dataset->color('#87bdd8');
        $dataset->backgroundColor('#b7d7e8');

        return $this;
    }
}
