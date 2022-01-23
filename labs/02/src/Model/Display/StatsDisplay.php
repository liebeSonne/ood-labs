<?php

namespace App\Model\Display;

use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplay implements ObserverInterface
{
    private AvgStatsInterface $tempStats;
    private AvgStatsInterface $humStats;
    private AvgStatsInterface $presStats;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;

    public function __construct()
    {
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');

        $this->setTemperatureFormatter(new CelsiusTemperatureFormatter());
        $this->setPressureFormatter(new MmRtStPressureFormatter());
        $this->setHumidityFormatter(new PercentHumidityFormatter());
    }

    public function update(\StdClass $data, Observable $subject) : void
    {
        $this->tempStats->update($data->temperature);
        $this->humStats->update($data->humidity);
        $this->presStats->update($data->pressure);

        $this->display();
    }

    public function display() : void
    {
        echo "================\n";
        $this->tempFormatter->display($this->tempStats);
        $this->humFormatter->display($this->humStats);
        $this->pressFormatter->display($this->presStats);
        echo "================\n";
    }

    public function setTemperatureFormatter(AvgStatsFormatterInterface $tempFormatter): void
    {
        $this->tempFormatter = $tempFormatter;
    }

    public function setHumidityFormatter(AvgStatsFormatterInterface $humFormatter): void
    {
        $this->humFormatter = $humFormatter;
    }

    public function setPressureFormatter(AvgStatsFormatterInterface $pressFormatter): void
    {
        $this->pressFormatter = $pressFormatter;
    }
}
