<?php

namespace App\Model\Display\Stats\Formatter\Pressure;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Pressure\KPascalFormat;

class KPascalPressureFormatter extends Formatter
{
    public function __construct()
    {
        $format = new KPascalFormat();
        parent::__construct($format);
    }
}