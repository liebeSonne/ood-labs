<?php

namespace App\Model\Display\Info\Formatter;

use App\Model\Weather\WeatherInfoPro;

interface InfoProFormatterInterface
{
    public function display(WeatherInfoPro $data): void;
}