<?php

namespace App\Model\Display\Stats\Formatter\Humidity;

use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Format\HumidityFormat;

class PercentHumidityFormatter implements AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void
    {
        $format = HumidityFormat::PERCENT;
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