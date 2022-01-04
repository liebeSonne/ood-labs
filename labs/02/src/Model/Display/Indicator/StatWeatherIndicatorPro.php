<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\WindDirectionStat;

class StatWeatherIndicatorPro implements IndicatorInterface, WeatherProIndicatorInterface
{
    private \StdClass $data;

    private string $name;

    private AvgStats $tempStats;
    private AvgStats $humStats;
    private AvgStats $presStats;
    private AvgStats $windSpeed;
    private WindDirectionStat $windDirection;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->data = new \StdClass();
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');
        $this->windSpeed = new AvgStats('Wind Speed');
        $this->windDirection = new WindDirectionStat('Wind Direction');
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
        $this->tempStats->update($data->temperature);
        $this->humStats->update($data->humidity);
        $this->presStats->update($data->pressure);
        $this->windSpeed->update($this->data->windSpeed);
        $this->windDirection->update($this->data->windDirection);
    }

    public function display() : void
    {
        echo "=[" . $this->name . "]:\n";
        $this->tempStats->display();
        $this->humStats->display();
        $this->presStats->display();
        $this->windSpeed->display();
        $this->windDirection->display();
    }

    public function setTemp($data) : void
    {
        $this->data->temperature = $data;
        this->tempStats->update($data);
    }

    public function setHumidity($data) : void
    {
        $this->data->humidity = $data;
        $this->humStats->update($data);
    }

    public function setPressure($data) : void
    {
        $this->data->pressure = $data;
        $this->presStats->update($data);
    }

    public function setWindSpeed($data) : void
    {
        $this->data->windSpeed = $data;
        $this->windSpeed->update($this->data);
    }

    public function setWindDirection($data) : void
    {
        $this->data->windDirection = $data;
        $this->windDirection->update($this->data);
    }
}