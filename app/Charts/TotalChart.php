<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class TotalChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($title, $mini = false, $ax)
    {

        parent::__construct();
        $this->title($title);
        $this->labels(false);
        $this->displayLegend(false);
        $this->displayAxes($ax);


    }
}