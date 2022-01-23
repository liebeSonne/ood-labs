<?php

namespace App\Model\Display\Stats\Formatter\Pressure;

use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Format\PressureFormat;

class KPascalPressureFormatter implements AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void
    {
        $format = PressureFormat::MM_RT_ST;
        echo "--- " . $stats->getName() . ":\n";
        echo "Max: " . $this->prepareValue($stats->getMax()) . " " . $format . "\n";
        echo "Min: " . $this->prepareValue($stats->getMin()) . " " . $format . "\n";
        echo "Average: " . $this->prepareValue($stats->getAvg()) . " " . $format . "\n";
        echo "----------------\n";
    }

    private function prepareValue(float $value): float
    {
        $result = PressureFormat::toKPascal($value);
        return round($result, 2);
    }
}