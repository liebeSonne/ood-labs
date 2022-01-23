<?php

namespace App\Model\Display;

use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\WindDirectionStat;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplayPro implements ObserverInterface
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

    public function update(\StdClass $data, Observable $subject) : void
    {
        $this->tempStats->update($data->temperature);
        $this->humStats->update($data->humidity);
        $this->presStats->update($data->pressure);
        $this->windSpeedStats->update($data->windSpeed);
        $this->windDirectionStat->update($data->windDirection);

        $this->display();
    }

    public function display() : void
    {
        echo "================\n";
        $this->tempStats->display();
        $this->humStats->display();
        $this->presStats->display();
        $this->windSpeedStats->display();
        $this->windDirectionStat->display();
        echo "================\n";
    }
}
