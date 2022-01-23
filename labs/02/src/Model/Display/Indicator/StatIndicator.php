<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;

class StatIndicator implements IndicatorInterface
{
    private \StdClass $data;

    private string $name;

    private AvgStatsInterface $tempStats;
    private AvgStatsInterface $humStats;
    private AvgStatsInterface $presStats;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->data = new \StdClass();
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');

        $this->setTemperatureFormatter(new CelsiusTemperatureFormatter());
        $this->setPressureFormatter(new MmRtStPressureFormatter());
        $this->setHumidityFormatter(new PercentHumidityFormatter());
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
        $this->tempStats->update($this->data->temperature);
        $this->humStats->update($this->data->humidity);
        $this->presStats->update($this->data->pressure);
    }

    public function display() : void
    {
        echo "=[" . $this->name . "]:\n";
        $this->tempFormatter->display($this->tempStats);
        $this->humFormatter->display($this->humStats);
        $this->pressFormatter->display($this->presStats);
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