<?php

namespace App\Model\Weather\Format\Wind\Direction;

use App\Model\Format\Direction;
use App\Model\Weather\Format\FormatInterface;

class DegreesDirectionFormat implements FormatInterface
{
    public function format(float $value): string
    {
        return round($value, 2) . " " . Direction::DEGREES;
    }
}