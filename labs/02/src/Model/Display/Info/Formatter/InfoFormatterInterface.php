<?php

namespace App\Model\Display\Info\Formatter;

use App\Model\Weather\WeatherInfo;

interface InfoFormatterInterface
{
    public function display(WeatherInfo $data): void;
}