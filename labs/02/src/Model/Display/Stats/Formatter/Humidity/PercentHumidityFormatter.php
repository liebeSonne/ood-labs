<?php

namespace App\Model\Display\Stats\Formatter\Humidity;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Humidity\PercentFormat;

class PercentHumidityFormatter extends Formatter
{
    public function __construct()
    {
        $format = new PercentFormat();
        parent::__construct($format);
    }
}