<?php

namespace App\Model\Display\Stats\Formatter\Pressure;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Pressure\MmRtStFormat;

class MmRtStPressureFormatter extends Formatter
{
    public function __construct()
    {
        $format = new MmRtStFormat();
        parent::__construct($format);
    }
}