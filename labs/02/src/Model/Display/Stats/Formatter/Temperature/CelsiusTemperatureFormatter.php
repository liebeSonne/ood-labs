<?php

namespace App\Model\Display\Stats\Formatter\Temperature;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Temperature\CelsiusFormat;

class CelsiusTemperatureFormatter extends Formatter
{
    public function __construct()
    {
        $format = new CelsiusFormat();
        parent::__construct($format);
    }
}