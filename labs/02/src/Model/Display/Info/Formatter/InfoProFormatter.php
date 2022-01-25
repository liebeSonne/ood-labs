<?php

namespace App\Model\Display\Info\Formatter;

use App\Model\Weather\Format\FormatInterface;
use App\Model\Weather\WeatherInfoPro;

class InfoProFormatter implements InfoProFormatterInterface
{
    private FormatInterface $tempFormat;
    private FormatInterface $humFormat;
    private FormatInterface $pressFormat;
    private FormatInterface $windSpeedFormat;
    private FormatInterface $windDirectionFormat;

    public function __construct(
        FormatInterface $tempFormat,
        FormatInterface $humFormat,
        FormatInterface $pressFormat,
        FormatInterface $windSpeedFormat,
        FormatInterface $windDirectionFormat
    ) {
        $this->setTemperatureFormat($tempFormat);
        $this->setHumidityFormat($humFormat);
        $this->setPressureFormat($pressFormat);
        $this->setWindSpeedFormat($windSpeedFormat);
        $this->setWindDirectionFormat($windDirectionFormat);
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

    public function setWindSpeedFormat(FormatInterface $windSpeedFormat): void
    {
        $this->windSpeedFormat = $windSpeedFormat;
    }

    public function setWindDirectionFormat(FormatInterface $windDirectionFormat): void
    {
        $this->windDirectionFormat = $windDirectionFormat;
    }

    public function display(WeatherInfoPro $data): void
    {
        echo "Current Temp " . $this->tempFormat->format((float) $data->temperature) . "\n";
        echo "Current Hum  " . $this->humFormat->format((float) $data->humidity) . "\n";
        echo "Current Pressure  " . $this->pressFormat->format((float) $data->pressure) . "\n";
        echo "Current Wind Speed  " . $this->windSpeedFormat->format((float) $data->windSpeed) . "\n";
        echo "Current Wind Direction  " . $this->windDirectionFormat->format((float) $data->windDirection) . "\n";
    }
}