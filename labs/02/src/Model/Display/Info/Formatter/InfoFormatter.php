<?php

namespace App\Model\Display\Info\Formatter;

use App\Model\Weather\Format\FormatInterface;
use App\Model\Weather\WeatherInfo;

class InfoFormatter implements InfoFormatterInterface
{
    private FormatInterface $tempFormat;
    private FormatInterface $humFormat;
    private FormatInterface $pressFormat;

    public function __construct(FormatInterface $tempFormat, FormatInterface $humFormat, FormatInterface $pressFormat)
    {
        $this->setTemperatureFormat($tempFormat);
        $this->setHumidityFormat($humFormat);
        $this->setPressureFormat($pressFormat);
    }

    public function setTemperatureFormat(FormatInterface $tempFormat): void
    {
        $this->tempFormat = $tempFormat;
    }

    public function setHumidityFormat(FormatInterface $humFormat): void
    {
        $this->humFormat = $humFormat;
    }

    public function setPressureFormat(FormatInterface $pressFormat): void
    {
        $this->pressFormat = $pressFormat;
    }

    public function display(WeatherInfo $data): void
    {
        echo "Current Temp " . $this->tempFormat->format((float) $data->temperature) . "\n";
        echo "Current Hum  " . $this->humFormat->format((float) $data->humidity) . "\n";
        echo "Current Pressure  " . $this->pressFormat->format((float) $data->pressure) . "\n";
    }
}