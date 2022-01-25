<?php

namespace App\Model\Weather;

class WeatherInfo extends \StdClass
{
    public float $temperature = 0;
    public float $humidity = 0;
    public float $pressure = 0;

    public static function createInfo(\StdClass $data): WeatherInfo
    {
        $info = new self();
        $info->temperature = $data->temperature ?? null;
        $info->humidity = $data->humidity ?? null;
        $info->pressure = $data->pressure ?? null;
        return $info;
    }
}
