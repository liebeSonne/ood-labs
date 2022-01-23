<?php

namespace App\Model\Display\Stats\Formatter\Wind\Direction;

use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Format\Direction;

class WindDirectionFormatter implements AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void
    {
        $format = Direction::DEGREES;
        echo "--- " . $stats->getName() . ":\n";
        echo "Max: " . $this->prepareValue($stats->getMax()) . " " . $format . "\n";
        echo "Min: " . $this->prepareValue($stats->getMin()) . " " . $format . "\n";
        echo "Average: " . $this->prepareValue($stats->getAvg()) . " " . $format . "\n";
        echo "----------------\n";
    }

    private function prepareValue(float $value): float
    {
        return round($value, 2);
    }
}