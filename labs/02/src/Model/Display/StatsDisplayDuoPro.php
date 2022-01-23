<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\StatIndicator;
use App\Model\Display\Indicator\StatIndicatorPro;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;
use App\Model\Display\Stats\Formatter\Wind\Direction\WindDirectionFormatter;
use App\Model\Display\Stats\Formatter\Wind\Speed\WindSpeedFormatter;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplayDuoPro implements ObserverInterface
{
    private Observable $weatherDataIn;
    private Observable $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;
    private AvgStatsFormatterInterface $windSpeedFormatter;
    private AvgStatsFormatterInterface $windDirectionFormatter;

    public function __construct(Observable $weatherDataIn, Observable $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $this->inIndicator = new StatIndicator('In');
        $this->outIndicator = new StatIndicatorPro('Out');

        $this->setTemperatureFormatter(new CelsiusTemperatureFormatter());
        $this->setPressureFormatter(new MmRtStPressureFormatter());
        $this->setHumidityFormatter(new PercentHumidityFormatter());
        $this->setWindSpeedFormatter(new WindSpeedFormatter());
        $this->setWindDirectionFormatter(new WindDirectionFormatter());
    }

    public function update(\StdClass $data, Observable $subject) : void
    {
        if ($subject === $this->weatherDataIn)
        {
            $this->inIndicator->setData($data);
        }
        if ($subject === $this->weatherDataOut)
        {
            $this->outIndicator->setData($data);
        }

       $this->display();
    }

    public function display() : void
    {
        echo "================\n";
        $this->inIndicator->display();
        $this->outIndicator->display();
        echo "================\n";
    }

    public function setTemperatureFormatter(AvgStatsFormatterInterface $tempFormatter): void
    {
        $this->tempFormatter = $tempFormatter;
        $this->inIndicator->setTemperatureFormatter($this->tempFormatter);
        $this->outIndicator->setTemperatureFormatter($this->tempFormatter);
    }

    public function setHumidityFormatter(AvgStatsFormatterInterface $humFormatter): void
    {
        $this->humFormatter = $humFormatter;
        $this->inIndicator->setHumidityFormatter($this->humFormatter);
        $this->outIndicator->setHumidityFormatter($this->humFormatter);
    }

    public function setPressureFormatter(AvgStatsFormatterInterface $pressFormatter): void
    {
        $this->pressFormatter = $pressFormatter;
        $this->inIndicator->setPressureFormatter($this->pressFormatter);
        $this->outIndicator->setPressureFormatter($this->pressFormatter);
    }

    public function setWindSpeedFormatter(AvgStatsFormatterInterface $windSpeedFormatter): void
    {
        $this->windSpeedFormatter = $windSpeedFormatter;
        $this->outIndicator->setWindSpeedFormatter($this->windSpeedFormatter);
    }

    public function setWindDirectionFormatter(AvgStatsFormatterInterface $windDirectionFormatter): void
    {
        $this->windDirectionFormatter = $windDirectionFormatter;
        $this->outIndicator->setWindDirectionFormatter($this->windDirectionFormatter);
    }
}
