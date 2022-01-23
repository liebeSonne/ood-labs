<?php

namespace App\Model\Weather\Format\Temperature;

use App\Model\Format\TemperatureFormat;
use App\Model\Weather\Format\FormatInterface;

class CelsiusFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round($value, 2) . " " . TemperatureFormat::CELSIUS;
    }
}