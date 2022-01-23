<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\StatWeatherIndicatorPro;
use App\Model\Display\Indicator\StatWeatherIndicator;
use App\Model\Display\Slot\SlotDuoWeatherInterface;
use App\Model\Display\Stats\Formatter\AvgStatsFormatterInterface;
use App\Model\Display\Stats\Formatter\Humidity\PercentHumidityFormatter;
use App\Model\Display\Stats\Formatter\Pressure\MmRtStPressureFormatter;
use App\Model\Display\Stats\Formatter\Temperature\CelsiusTemperatureFormatter;
use App\Model\Display\Stats\Formatter\Wind\Direction\WindDirectionFormatter;
use App\Model\Display\Stats\Formatter\Wind\Speed\WindSpeedFormatter;
use App\Model\Weather\WeatherData;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplayDuoProSlot implements ObserverInterface, SlotDuoWeatherInterface
{
    private WeatherData $weatherDataIn;
    private WeatherData $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    private AvgStatsFormatterInterface $tempFormatter;
    private AvgStatsFormatterInterface $humFormatter;
    private AvgStatsFormatterInterface $pressFormatter;
    private AvgStatsFormatterInterface $windSpeedFormatter;
    private AvgStatsFormatterInterface $windDirectionFormatter;

    public function __construct(WeatherData $weatherDataIn, WeatherData $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $this->inIndicator = new StatWeatherIndicator('In');
        $this->outIndicator = new StatWeatherIndicatorPro('Out');

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

    public function slotInTemp($data) : void
    {
        $this->inIndicator->setTemp($data);
        $this->display();
    }

    public function slotInHumidity($data) : void
    {
        $this->inIndicator->setHumidity($data);
        $this->display();
    }

    public function slotInPressure($data) : void
    {
        $this->inIndicator->setPressure($data);
        $this->display();
    }

    public function slotOutTemp($data) : void
    {
        $this->outIndicator->setTemp($data);
        $this->display();
    }

    public function slotOutHumidity($data) : void
    {
        $this->outIndicator->setHumidity($data);
        $this->display();
    }

    public function slotOutPressure($data) : void
    {
        $this->outIndicator->setPressure($data);
        $this->display();
    }

    public function slotOutWindSpeed($data) : void
    {
        $this->outIndicator->setWindSpeed($data);
        $this->display();
    }

    public function slotOutWindDirection($data) : void
    {
        $this->outIndicator->setWindDirection($data);
        $this->display();
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
