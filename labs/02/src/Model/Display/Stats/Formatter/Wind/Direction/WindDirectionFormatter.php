<?php

namespace App\Model\Display\Stats\Formatter\Wind\Direction;

use App\Model\Display\Stats\Formatter\Formatter;
use App\Model\Weather\Format\Wind\Direction\DegreesDirectionFormat;

class WindDirectionFormatter extends Formatter
{
    public function __construct()
    {
        $format = new DegreesDirectionFormat();
        parent::__construct($format);
    }
}