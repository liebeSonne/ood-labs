<?php

namespace App\Model\Weather;

class WeatherInfoPro extends \StdClass
{
    public float $temperature = 0;
    public float $humidity = 0;
    public float $pressure = 0;
    public float $windSpeed = 0;
    public int $windDirection = 0;
}
