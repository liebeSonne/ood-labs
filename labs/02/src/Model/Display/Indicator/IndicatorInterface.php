<?php

namespace App\Model\Display\Indicator;

use App\Model\Weather\WeatherInfo;

interface IndicatorInterface
{
    public function setData(WeatherInfo $data) : void;
    public function display() : void;
}