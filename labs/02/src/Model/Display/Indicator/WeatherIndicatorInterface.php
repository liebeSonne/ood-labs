<?php

namespace App\Model\Display\Indicator;

interface WeatherIndicatorInterface
{
    public function display() : void;

    public function setTemp(float $data) : void;
    public function setHumidity(float $data) : void;
    public function setPressure(float $data) : void;
}