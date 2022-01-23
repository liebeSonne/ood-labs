<?php

namespace App\Model\Display\Stats\Formatter;

use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Weather\Format\FormatInterface;

class Formatter implements AvgStatsFormatterInterface
{
    private FormatInterface $format;

    public function __construct(FormatInterface $format)
    {
        $this->setFormat($format);
    }

    public function setFormat(FormatInterface $format): void
    {
        $this->format = $format;
    }

    public function display(AvgStatsInterface $stats): void
    {
        echo "--- " . $stats->getName() . ":\n";
        echo "Max: " . $this->format->format($stats->getMax()) . "\n";
        echo "Min: " . $this->format->format($stats->getMin()) . "\n";
        echo "Average: " . $this->format->format($stats->getAvg()) . "\n";
        echo "----------------\n";
    }
}