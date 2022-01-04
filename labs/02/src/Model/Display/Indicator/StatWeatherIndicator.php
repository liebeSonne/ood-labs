<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Stats\AvgStats;

class StatWeatherIndicator implements IndicatorInterface, WeatherIndicatorInterface
{
    private \StdClass $data;

    private string $name;

    private AvgStats $tempStats;
    private AvgStats $humStats;
    private AvgStats $presStats;


    public function __construct(string $name)
    {
        $this->name = $name;
        $this->data = new \StdClass();
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
        $this->tempStats->update($data->temperature);
        $this->humStats->update($data->humidity);
        $this->presStats->update($data->pressure);
    }

    public function display() : void
    {
        echo "=[" . $this->name . "]:\n";
        $this->tempStats->display();
        $this->humStats->display();
        $this->presStats->display();
    }

    public function setTemp($data) : void
    {
        $this->data->temperature = $data;
        $this->tempStats->update($data);
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
}