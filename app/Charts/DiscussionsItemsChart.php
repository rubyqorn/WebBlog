<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Discussion;

class DiscussionsItemsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDiscussionsByMonth(string $month)
    {
        return Discussion::whereMonth('created_at', $month)->count();
    }

    protected function countDiscussionsByMonth()
    {
        return [
            $this->getDiscussionsByMonth('01'),
            $this->getDiscussionsByMonth('02'),
            $this->getDiscussionsByMonth('03'),
            $this->getDiscussionsByMonth('04'),
            $this->getDiscussionsByMonth('05'),
            $this->getDiscussionsByMonth('06'),
            $this->getDiscussionsByMonth('07'),
            $this->getDiscussionsByMonth('08'),
            $this->getDiscussionsByMonth('09'),
            $this->getDiscussionsByMonth('10'),
            $this->getDiscussionsByMonth('11'),
            $this->getDiscussionsByMonth('12')
        ];
    }

    public function create()
    {
        $discussions = $this->countDiscussionsByMonth();

        $this->labels([
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ]);

        $dataset = $this->dataset(
            'Статистика созданных обсуждений помесячно',
            'line', $discussions
        );

        $dataset->color('#87bdd8');
        $dataset->backgroundColor('#b7d7e8');

        return $this;
    }
}
