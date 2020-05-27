<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\News;

class NewsItemsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getNewsByMonth(string $month)
    {
        return News::whereMonth('created_at', $month)->count();
    }

    protected function countNewsByMonth()
    {
        return [
            $this->getNewsByMonth('01'),
            $this->getNewsByMonth('02'),
            $this->getNewsByMonth('03'),
            $this->getNewsByMonth('04'),
            $this->getNewsByMonth('05'),
            $this->getNewsByMonth('06'),
            $this->getNewsByMonth('07'),
            $this->getNewsByMonth('08'),
            $this->getNewsByMonth('09'),
            $this->getNewsByMonth('10'),
            $this->getNewsByMonth('11'),
            $this->getNewsByMonth('12')
        ];
    }

    public function create()
    {
        $newsByMonth = $this->countNewsByMonth();

        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);
        $dataset = $this->dataset(
            'Статистика новостей добавленных по месяцам',
            'line', $newsByMonth
        );

        $dataset->color('#87bdd8');
        $dataset->backgroundColor('#b7d7e8');

        return $this;

    }
}
