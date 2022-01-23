<?php

namespace App\Model\Weather\Format\Temperature;

use App\Model\Format\TemperatureFormat;
use App\Model\Weather\Format\FormatInterface;

class FahrenheitFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round(TemperatureFormat::toFahrenheit($value), 2) . " " . TemperatureFormat::FAHRENHEIT;
    }
}