<?php

namespace App\Model\Weather;

class WeatherInfoPro extends \StdClass
{
    public float $temperature = 0;
    public float $humidity = 0;
    public float $pressure = 0;
    public float $windSpeed = 0;
    public int $windDirection = 0;

    public static function createInfo(\StdClass $data): WeatherInfoPro
    {
        $info = new self();
        $info->temperature = $data->temperature ?? null;
        $info->humidity = $data->humidity ?? null;
        $info->pressure = $data->pressure ?? null;
        $info->windSpeed = $data->windSpeed ?? null;
        $info->windDirection = $data->windDirection ?? null;
        return $info;
    }
}
