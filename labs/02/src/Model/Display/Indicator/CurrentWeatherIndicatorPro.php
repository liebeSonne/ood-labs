<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Info\Formatter\InfoProFormatterInterface;
use App\Model\Weather\WeatherInfoPro;

class CurrentWeatherIndicatorPro implements IndicatorProInterface, WeatherProIndicatorInterface
{
    private WeatherInfoPro $data;

    private string $name;

    private InfoProFormatterInterface $formatter;

    public function __construct(string $name, InfoProFormatterInterface $formatter)
    {
        $this->name = $name;
        $this->data = new WeatherInfoPro();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoProFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
    }

    public function setData(WeatherInfoPro $data) : void
    {
        $this->data = $data;
    }

    public function display() : void
    {
        echo "-[" . $this->name . "]: \n";
        $this->formatter->display($this->data);
    }

    public function setTemp(float $data) : void
    {
        $this->data->temperature = $data;
    }

    public function setHumidity(float $data) : void
    {
        $this->data->humidity = $data;
    }

    public function setPressure(float $data) : void
    {
        $this->data->pressure = $data;
    }

    public function setWindSpeed(float $data) : void
    {
        $this->data->windSpeed = $data;
    }

    public function setWindDirection(float $data) : void
    {
        $this->data->windDirection = $data;
    }
}