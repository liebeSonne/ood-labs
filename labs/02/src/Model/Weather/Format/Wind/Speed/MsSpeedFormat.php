<?php

namespace App\Model\Weather\Format\Wind\Speed;

use App\Model\Format\Speed;
use App\Model\Weather\Format\FormatInterface;

class MsSpeedFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round($value, 2) . " " . Speed::MS;
    }
}