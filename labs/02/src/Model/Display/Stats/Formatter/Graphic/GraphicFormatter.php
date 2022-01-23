<?php

namespace App\Model\Display\Stats\Formatter\Graphic;

use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;

class GraphicFormatter implements AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void
    {
        echo "Draw Graphic Stats\n";
    }
}