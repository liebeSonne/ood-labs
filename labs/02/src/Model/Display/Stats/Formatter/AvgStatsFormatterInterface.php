<?php

namespace App\Model\Display\Stats\Formatter;

use App\Model\Display\Stats\AvgStatsInterface;

interface AvgStatsFormatterInterface
{
    public function display(AvgStatsInterface $stats): void;
}