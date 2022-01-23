<?php

namespace App\Model\Display\Stats\Formatter\Wind\Speed;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Wind\Speed\MsSpeedFormat;

class WindSpeedFormatter extends Formatter
{
    public function __construct()
    {
        $format = new MsSpeedFormat();
        parent::__construct($format);
    }
}
