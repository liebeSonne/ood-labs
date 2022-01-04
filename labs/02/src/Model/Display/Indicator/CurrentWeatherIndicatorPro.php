<?php

namespace App\Model\Display\Indicator;

use App\Model\Weather\WeatherInfoPro;

class CurrentWeatherIndicatorPro implements IndicatorInterface, WeatherProIndicatorInterface
{
    private \StdClass $data;

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->data = new WeatherInfoPro();
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
    }

    public function display() : void
    {
        echo "-[" . $this->name . "]: \n";
        echo "Current Temp " . $this->data->temperature . "\n";
        echo "Current Hum  " . $this->data->humidity . "\n";
        echo "Current Pressure  " . $this->data->pressure . "\n";
        echo "Current Wind Speed  " . $this->data->windSpeed . "\n";
        echo "Current Wind Direction  " . $this->data->windDirection . "\n";
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