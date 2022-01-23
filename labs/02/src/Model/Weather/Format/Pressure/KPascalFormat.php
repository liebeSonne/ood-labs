<?php

namespace App\Model\Weather\Format\Pressure;

use App\Model\Format\PressureFormat;
use App\Model\Weather\Format\FormatInterface;

class KPascalFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round(PressureFormat::toKPascal($value), 2) . " " . PressureFormat::K_PASCAL;
    }
}