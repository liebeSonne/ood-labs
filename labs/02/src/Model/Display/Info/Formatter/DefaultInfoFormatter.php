<?php

namespace App\Model\Display\Info\Formatter;

use App\Model\Weather\Format\Humidity\PercentFormat;
use App\Model\Weather\Format\Pressure\MmRtStFormat;
use App\Model\Weather\Format\Temperature\CelsiusFormat;

class DefaultInfoFormatter extends InfoFormatter
{
    public function __construct()
    {
        parent::__construct(
            new CelsiusFormat(),
            new PercentFormat(),
            new MmRtStFormat()
        );
    }
}