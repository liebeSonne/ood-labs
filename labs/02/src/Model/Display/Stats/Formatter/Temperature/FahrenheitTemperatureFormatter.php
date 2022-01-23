<?php

namespace App\Model\Display\Stats\Formatter\Temperature;

use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Format\TemperatureFormat;

class FahrenheitTemperatureFormatter implements AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void
    {
        $format = TemperatureFormat::FAHRENHEIT;
        echo "--- " . $stats->getName() . ":\n";
        echo "Max: " . $this->prepareValue($stats->getMax()) . " " . $format . "\n";
        echo "Min: " . $this->prepareValue($stats->getMin()) . " " . $format . "\n";
        echo "Average: " . $this->prepareValue($stats->getAvg()) . " " . $format . "\n";
        echo "----------------\n";
    }

    private function prepareValue(float $value): float
    {
        $result = TemperatureFormat::toFahrenheit($value);
        return round($result, 2);
    }
}