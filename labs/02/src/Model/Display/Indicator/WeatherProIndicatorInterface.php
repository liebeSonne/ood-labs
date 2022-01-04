<?php

namespace App\Model\Display\Indicator;

interface WeatherProIndicatorInterface
{
    public function display() : void;

    public function setTemp($data) : void;
    public function setHumidity($data) : void;
    public function setPressure($data) : void;

    public function setWindSpeed($data) : void;
    public function setWindDirection($data) : void;
}