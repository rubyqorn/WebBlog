<?php 

namespace App\Traits;

use App\Charts\CountRecordsPerMonth;

trait CountRecordsForCharts
{
	/**
	/**
	* Get counted records per month, also
	* create App\Charts\CountRecordsPerMonth object
	* set labels type and pass data for feature chart
	*
	* @param $model object
	*
	* @return object App\Charts\CountRecordsPerMonth
	*/ 
	public static function chart(object $model)
	{
		if (is_object($model)) {
			
			$countedRecords = [
				$model->getRecordsByMonth('01'),
				$model->getRecordsByMonth('02'),
				$model->getRecordsByMonth('03'),
				$model->getRecordsByMonth('04'),
				$model->getRecordsByMonth('05'),
				$model->getRecordsByMonth('06'),
				$model->getRecordsByMonth('07'),
				$model->getRecordsByMonth('08'),
				$model->getRecordsByMonth('09'),
				$model->getRecordsByMonth('10'),
				$model->getRecordsByMonth('11'),
				$model->getRecordsByMonth('12'),
			];

			$chart = new CountRecordsPerMonth();
			$chart->labels([
				'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN',
                'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'
			]);
			$chart->dataset('Статистика по добавленным записям помесячно', 'line', $countedRecords);

			return $chart;
		}
	}
}