<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\StatIndicator;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;
use App\Model\Weather\WeatherInfo;
use App\Observer\ObservableInterface;
use App\Observer\ObserverInterface;

class StatsDisplayDuo implements ObserverInterface
{
    private ObservableInterface $weatherDataIn;
    private ObservableInterface $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;

    public function __construct(ObservableInterface $weatherDataIn, ObservableInterface $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $this->inIndicator = new StatIndicator('In');
        $this->outIndicator = new StatIndicator('Out');

        $this->setTemperatureFormatter(new CelsiusTemperatureFormatter());
        $this->setPressureFormatter(new MmRtStPressureFormatter());
        $this->setHumidityFormatter(new PercentHumidityFormatter());
    }

    public function update(\StdClass $data, ObservableInterface $subject) : void
    {
        $info = WeatherInfo::createInfo($data);

        if ($subject === $this->weatherDataIn)
        {
            $this->inIndicator->setData($info);
        }
        if ($subject === $this->weatherDataOut)
        {
            $this->outIndicator->setData($info);
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
}
