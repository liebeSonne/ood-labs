<?php

namespace App\Model\Display\Indicator;

use App\Model\Weather\WeatherInfoPro;

interface IndicatorProInterface
{
    public function setData(WeatherInfoPro $data) : void;
    public function display() : void;
}