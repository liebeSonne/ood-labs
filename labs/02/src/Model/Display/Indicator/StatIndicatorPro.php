<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\AvgWindDirectionStats;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;
use App\Model\Display\Stats\Formatter\Wind\Direction\WindDirectionFormatter;
use App\Model\Display\Stats\Formatter\Wind\Speed\WindSpeedFormatter;

class StatIndicatorPro implements IndicatorInterface
{
    private \StdClass $data;

    private string $name;

    private AvgStatsInterface $tempStats;
    private AvgStatsInterface $humStats;
    private AvgStatsInterface $presStats;
    private AvgStatsInterface $windSpeed;
    private AvgStatsInterface $windDirection;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;
    private AvgStatsFormatterInterface $windSpeedFormatter;
    private AvgStatsFormatterInterface $windDirectionFormatter;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->data = new \StdClass();
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');
        $this->windSpeed = new AvgStats('Wind Speed');
        $this->windDirection = new AvgWindDirectionStats('Wind Direction');

        $this->setTemperatureFormatter(new CelsiusTemperatureFormatter());
        $this->setPressureFormatter(new MmRtStPressureFormatter());
        $this->setHumidityFormatter(new PercentHumidityFormatter());
        $this->setWindSpeedFormatter(new WindSpeedFormatter());
        $this->setWindDirectionFormatter(new WindDirectionFormatter());
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
        $this->tempFormatter->display($this->tempStats);
        $this->humFormatter->display($this->humStats);
        $this->pressFormatter->display($this->presStats);
        $this->windSpeedFormatter->display($this->windSpeed);
        $this->windDirectionFormatter->display($this->windDirection);
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

    public function setWindSpeedFormatter(AvgStatsFormatterInterface $windSpeedFormatter): void
    {
        $this->windSpeedFormatter = $windSpeedFormatter;
    }

    public function setWindDirectionFormatter(AvgStatsFormatterInterface $windDirectionFormatter): void
    {
        $this->windDirectionFormatter = $windDirectionFormatter;
    }
}