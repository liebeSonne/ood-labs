<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentWeatherIndicatorPro;
use App\Model\Display\Indicator\CurrentWeatherIndicator;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\IndicatorProInterface;
use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\DefaultInfoProFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Model\Display\Info\Formatter\InfoProFormatterInterface;
use App\Model\Display\Slot\SlotDuoWeatherInterface;
use App\Model\Weather\WeatherInfo;
use App\Model\Weather\WeatherInfoPro;
use App\Observer\ObservableInterface;
use App\Observer\ObserverInterface;

class DisplayDuoProSlot implements ObserverInterface, SlotDuoWeatherInterface
{
    private ObservableInterface $weatherDataIn;
    private ObservableInterface $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorProInterface $outIndicator;

    private InfoFormatterInterface $formatter;
    private InfoProFormatterInterface $formatterPro;

    public function __construct(ObservableInterface $weatherDataIn, ObservableInterface $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $formatter = new DefaultInfoFormatter();
        $formatterPro = new DefaultInfoProFormatter();

        $this->inIndicator = new CurrentWeatherIndicator('In', $formatter);
        $this->outIndicator = new CurrentWeatherIndicatorPro('Out', $formatterPro);

        $this->setFormatter($formatter);
        $this->setFormatterPro($formatterPro);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
        $this->inIndicator->setFormatter($this->formatter);
    }

    public function setFormatterPro(InfoProFormatterInterface $formatterPro) : void
    {
        $this->formatterPro = $formatterPro;
        $this->outIndicator->setFormatter($this->formatterPro);
    }

    public function update(\StdClass $data, ObservableInterface $subject) : void
    {
        if ($subject === $this->weatherDataIn)
        {
            $info = WeatherInfo::createInfo($data);
            $this->inIndicator->setData($info);
        }
        if ($subject === $this->weatherDataOut)
        {
            $info = WeatherInfoPro::createInfo($data);
            $this->outIndicator->setData($info);
        }

        $this->display();
    }

    private function display() : void
    {
        echo "----------------\n";
        $this->inIndicator->display();
        $this->outIndicator->display();
        echo "----------------\n";
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
}