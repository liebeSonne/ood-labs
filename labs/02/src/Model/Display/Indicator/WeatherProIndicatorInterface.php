<?php

namespace App\Model\Display\Indicator;

interface WeatherProIndicatorInterface
{
    public function display() : void;

    public function setTemp(float $data) : void;
    public function setHumidity(float $data) : void;
    public function setPressure(float $data) : void;

    public function setWindSpeed(float $data) : void;
    public function setWindDirection(float $data) : void;
}