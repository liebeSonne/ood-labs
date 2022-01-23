<?php

namespace App\Model\Display\Stats\Formatter\Temperature;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Temperature\FahrenheitFormat;

class FahrenheitTemperatureFormatter extends Formatter
{
    public function __construct()
    {
        $format = new FahrenheitFormat();
        parent::__construct($format);
    }
}