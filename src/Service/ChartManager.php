<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartManager extends AbstractController
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
    )
    {
    }

    public function createBarChartBy(
        array $labels = [],
        array $data = [],
        string $title = 'Change Me',
        string $bgColor = '#241C52',
        int $yMax = null,
        int $yMin = null,
    )
    {
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

        if(!isset($yMax)) $yMax = max($data);
        if(!isset($yMin)) $yMin = min($data);

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
