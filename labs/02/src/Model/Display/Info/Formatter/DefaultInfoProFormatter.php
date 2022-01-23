<?php

namespace App\Model\Display\Info\Formatter;

use App\Model\Weather\Format\Humidity\PercentFormat;
use App\Model\Weather\Format\Pressure\MmRtStFormat;
use App\Model\Weather\Format\Temperature\CelsiusFormat;
use App\Model\Weather\Format\Wind\Direction\DegreesDirectionFormat;
use App\Model\Weather\Format\Wind\Speed\MsSpeedFormat;

class DefaultInfoProFormatter extends InfoProFormatter
{
    public function __construct()
    {
        parent::__construct(
            new CelsiusFormat(),
            new PercentFormat(),
            new MmRtStFormat(),
            new MsSpeedFormat(),
            new DegreesDirectionFormat()
        );
    }
}