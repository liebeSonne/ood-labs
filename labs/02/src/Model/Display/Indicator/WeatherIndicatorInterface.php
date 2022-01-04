<?php

namespace App\Model\Display\Indicator;

interface WeatherIndicatorInterface
{
    public function display() : void;

    public function setTemp($data) : void;
    public function setHumidity($data) : void;
    public function setPressure($data) : void;
}