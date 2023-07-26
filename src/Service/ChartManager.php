<?php

namespace App\Service;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartManager
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
    ) {
    }

    public function createBarChartBy(
        string $title,
        array $labels = [],
        array $data = [],
        string $bgColor = '#000000',
        int $yMax = null,
        int $yMin = null,
    ): Chart {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => $title,
                    'backgroundColor' => $bgColor,
                    'data' => $data,
                ],
            ],
        ]);

        if (!isset($yMax)) {
            $yMax = max($data);
        }
        if (!isset($yMin)) {
            $yMin = min($data);
        }

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => $yMin,
                    'suggestedMax' => $yMax,
                ]
            ]
        ]);

        return $chart;
    }
}
