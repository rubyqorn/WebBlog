<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\NewsCategory;

class NewsCategoriesChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getCategoriesByMonth(string $month)
    {
        return NewsCategory::whereMonth('created_at', $month)->count();
    }

    protected function countCategoriesByMonth()
    {
        return [
            $this->getCategoriesByMonth('01'),
            $this->getCategoriesByMonth('02'),
            $this->getCategoriesByMonth('03'),
            $this->getCategoriesByMonth('04'),
            $this->getCategoriesByMonth('05'),
            $this->getCategoriesByMonth('06'),
            $this->getCategoriesByMonth('07'),
            $this->getCategoriesByMonth('08'),
            $this->getCategoriesByMonth('09'),
            $this->getCategoriesByMonth('10'),
            $this->getCategoriesByMonth('11'),
            $this->getCategoriesByMonth('12')
        ];
    }

    public function create()
    {
        $categories = $this->countCategoriesByMonth();
        
        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);
        $dataset = $this->dataset(
            'Статистика созданных категорий по месяцам',
            'polarArea', $categories
        );

        $dataset->backgroundColor([
            '#6b5b95', '#feb236', '#d64161','#ff7b25','#eca1a6','#ff6f69',
            '#ffcc5c','#588c7e','#5b9aa0','#667292','#87bdd8','#ffef96',
        ]);

        return $this;
    }
}
