<?php

namespace App\Model\Display;

use App\Event\EventListenerInterface;
use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Model\Weather\WeatherDataProEvent;
use App\Model\Weather\WeatherInfoPro;

class DisplayProEvent implements EventListenerInterface
{
    private \StdClass $data;

    private InfoFormatterInterface $formatter;

    public function __construct()
    {
        $this->data = new WeatherInfoPro();
        $formatter = new DefaultInfoFormatter();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
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
        $this->formatter->display($this->data);
        echo "----------------\n";
    }
}