<?php

namespace App\Model\Display;

use App\Event\EventListenerInterface;
use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\WindDirectionStat;
use App\Model\Weather\WeatherDataProEvent;

class StatsDisplayProEvent implements EventListenerInterface
{
    private AvgStats $tempStats;
    private AvgStats $humStats;
    private AvgStats $presStats;
    private AvgStats $windSpeedStats;
    private WindDirectionStat $windDirectionStat;

    public function __construct()
    {
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');
        $this->windSpeedStats = new AvgStats('Wind Speed');
        $this->windDirectionStat = new WindDirectionStat('Wind Direction');
    }

    public function update(string $event, $data)  : void
    {
        switch ($event)
        {
            case WeatherDataProEvent::EVENT_TEMP:
                $this->tempStats->update($data);
                break;
            case WeatherDataProEvent::EVENT_HUMIDITY:
                $this->humStats->update($data);
                break;
            case WeatherDataProEvent::EVENT_PRESSURE:
                $this->presStats->update($data);
                break;
            case WeatherDataProEvent::EVENT_WIND_SPEED:
                $this->windSpeedStats->update($data);
                break;
            case WeatherDataProEvent::EVENT_WIND_DIRECTION:
                $this->windDirectionStat->update($data);
                break;
        }

        $this->display();
    }

    public function display() : void
    {
        echo "================\n";
        $this->tempStats->display();
        $this->humStats->display();
        $this->presStats->display();
        //$this->windSpeedStats->display();
        //$this->windDirectionStat->display();
        echo "================\n";
    }
}
