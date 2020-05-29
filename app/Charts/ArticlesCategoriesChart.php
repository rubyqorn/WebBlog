<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\ArticleCategory;

class ArticlesCategoriesChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getArticlesCategoriesByMonth(string $month)
    {
        return ArticleCategory::whereMonth('created_at', $month)->count();
    }

    protected function countCategoriesByMonth()
    {
        return [
            $this->getArticlesCategoriesByMonth('01'),
            $this->getArticlesCategoriesByMonth('02'),
            $this->getArticlesCategoriesByMonth('03'),
            $this->getArticlesCategoriesByMonth('04'),
            $this->getArticlesCategoriesByMonth('05'),
            $this->getArticlesCategoriesByMonth('06'),
            $this->getArticlesCategoriesByMonth('07'),
            $this->getArticlesCategoriesByMonth('08'),
            $this->getArticlesCategoriesByMonth('09'),
            $this->getArticlesCategoriesByMonth('10'),
            $this->getArticlesCategoriesByMonth('11'),
            $this->getArticlesCategoriesByMonth('12')
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
            'Статистика добавленных категорий помесячно',
            'polarArea', $categories
        );
        $dataset->backgroundColor([
            '#6b5b95', '#feb236', '#d64161','#ff7b25','#eca1a6','#ff6f69',
            '#ffcc5c','#588c7e','#5b9aa0','#667292','#87bdd8','#ffef96'
        ]);

        return $this;
    }
}
