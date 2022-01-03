<?php

namespace App\Model\Display;

use App\Model\Display\Stats\AvgStats;
use App\Observer\ObserverInterface;

class StatsDisplay implements ObserverInterface
{
    private AvgStats $tempStats;
    private AvgStats $humStats;
    private AvgStats $presStats;

    public function __construct()
    {
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');
    }

    public function update(\StdClass $data) : void
    {
        $this->tempStats->update($data->temperature);
        $this->humStats->update($data->humidity);
        $this->presStats->update($data->pressure);

        $this->display();
    }

    public function display() : void
    {
        echo "================\n";
        $this->tempStats->display();
        $this->humStats->display();
        $this->presStats->display();
        echo "================\n";
    }
}
