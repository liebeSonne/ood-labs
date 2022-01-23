<?php

namespace App\Model\Display\Stats\Formatter;

use App\Model\Display\Stats\AvgStatsInterface;

class DefaultFormatter implements AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void
    {
        echo "--- " . $stats->getName() . ":\n";
        echo "Max: " . $stats->getMax() . "\n";
        echo "Min: " . $stats->getMin() . "\n";
        echo "Average: " . $stats->getAvg() . "\n";
        echo "----------------\n";
    }
}