<?php

namespace App\Model\Display;

use App\Model\Display\Stats\AvgStats;
use App\Model\Display\Stats\AvgStatsInterface;
use App\Model\Display\Stats\AvgWindDirectionStats;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;
use App\Model\Display\Stats\Formatter\Wind\Direction\WindDirectionFormatter;
use App\Model\Display\Stats\Formatter\Wind\Speed\WindSpeedFormatter;
use App\Model\Weather\WeatherInfoPro;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplayPro implements ObserverInterface
{
    private AvgStatsInterface $tempStats;
    private AvgStatsInterface $humStats;
    private AvgStatsInterface $presStats;
    private AvgStatsInterface $windSpeedStats;
    private AvgStatsInterface $windDirectionStat;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;
    private AvgStatsFormatterInterface $windSpeedFormatter;
    private AvgStatsFormatterInterface $windDirectionFormatter;

    public function __construct()
    {
        $this->tempStats = new AvgStats('Temperature');
        $this->humStats = new AvgStats('Humidity');
        $this->presStats = new AvgStats('Pressure');
        $this->windSpeedStats = new AvgStats('Wind Speed');
        $this->windDirectionStat = new AvgWindDirectionStats('Wind Direction');

        $this->setTemperatureFormatter(new CelsiusTemperatureFormatter());
        $this->setPressureFormatter(new MmRtStPressureFormatter());
        $this->setHumidityFormatter(new PercentHumidityFormatter());
        $this->setWindSpeedFormatter(new WindSpeedFormatter());
        $this->setWindDirectionFormatter(new WindDirectionFormatter());
    }

    public function update(\StdClass $data, Observable $subject) : void
    {
        $info = WeatherInfoPro::createInfo($data);

        $this->tempStats->update($info->temperature);
        $this->humStats->update($info->humidity);
        $this->presStats->update($info->pressure);
        $this->windSpeedStats->update($info->windSpeed);
        $this->windDirectionStat->update($info->windDirection);

        $this->display();
    }

    public function display() : void
    {
        echo "================\n";
        $this->tempFormatter->display($this->tempStats);
        $this->humFormatter->display($this->humStats);
        $this->pressFormatter->display($this->presStats);
        $this->windSpeedFormatter->display($this->windSpeedStats);
        $this->windDirectionFormatter->display($this->windDirectionStat);
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

    public function setWindSpeedFormatter(AvgStatsFormatterInterface $windSpeedFormatter): void
    {
        $this->windSpeedFormatter = $windSpeedFormatter;
    }

    public function setWindDirectionFormatter(AvgStatsFormatterInterface $windDirectionFormatter): void
    {
        $this->windDirectionFormatter = $windDirectionFormatter;
    }
}
