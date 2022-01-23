<?php

namespace App\Model\Weather\Format\Humidity;

use App\Model\Format\HumidityFormat;
use App\Model\Weather\Format\FormatInterface;

class PercentFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round($value, 2) . " " . HumidityFormat::PERCENT;
    }
}