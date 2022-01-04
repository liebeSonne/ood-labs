<?php

namespace App\Model\Display;

use App\Event\EventListenerInterface;
use App\Model\Weather\WeatherDataProEvent;
use App\Model\Weather\WeatherInfoPro;

class DisplayProEvent implements EventListenerInterface
{
    protected \StdClass $data;

    public function __construct()
    {
        $this->data = new WeatherInfoPro();
    }

    public function update(string $event, $data)  : void
    {
        switch ($event)
        {
            case WeatherDataProEvent::EVENT_TEMP:
                $this->data->temperature = $data;
                break;
            case WeatherDataProEvent::EVENT_HUMIDITY:
                $this->data->humidity = $data;
                break;
            case WeatherDataProEvent::EVENT_PRESSURE:
                $this->data->pressure = $data;
                break;
            case WeatherDataProEvent::EVENT_WIND_SPEED:
                $this->data->windSpeed = $data;
                break;
            case WeatherDataProEvent::EVENT_WIND_DIRECTION:
                $this->data->windDirection = $data;
                break;
        }

        $this->display();
    }

    public function display() : void
    {
        echo "Current Temp " . $this->data->temperature . "\n";
        echo "Current Hum  " . $this->data->humidity . "\n";
        echo "Current Pressure  " . $this->data->pressure . "\n";
        //echo "Current Wind Speed  " . $this->data->windSpeed . "\n";
        //echo "Current Wind Direction  " . $this->data->windDirection . "\n";
        echo "----------------\n";
    }
}