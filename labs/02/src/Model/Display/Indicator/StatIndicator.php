<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Stats\AvgStats;

class StatIndicator implements IndicatorInterface
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
}