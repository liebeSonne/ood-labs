<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Model\Weather\WeatherInfoPro;

class CurrentWeatherIndicatorPro implements IndicatorInterface, WeatherProIndicatorInterface
{
    private \StdClass $data;

    private string $name;

    private InfoFormatterInterface $formatter;

    public function __construct(string $name, InfoFormatterInterface $formatter)
    {
        $this->name = $name;
        $this->data = new WeatherInfoPro();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
    }

    public function display() : void
    {
        echo "-[" . $this->name . "]: \n";
        $this->formatter->display($this->data);
    }

    public function setTemp($data) : void
    {
        $this->data->temperature = $data;
    }

    public function setHumidity($data) : void
    {
        $this->data->humidity = $data;
    }

    public function setPressure($data) : void
    {
        $this->data->pressure = $data;
    }

    public function setWindSpeed($data) : void
    {
        $this->data->windSpeed = $data;
    }

    public function setWindDirection($data) : void
    {
        $this->data->windDirection = $data;
    }
}