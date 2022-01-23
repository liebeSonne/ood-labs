<?php

namespace App\Model\Weather\Format\Pressure;

use App\Model\Format\PressureFormat;
use App\Model\Weather\Format\FormatInterface;

class MmRtStFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round($value, 2) . " " . PressureFormat::MM_RT_ST;
    }
}