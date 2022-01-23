<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentWeatherIndicatorPro;
use App\Model\Display\Indicator\CurrentWeatherIndicator;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\DefaultInfoProFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Model\Display\Slot\SlotDuoWeatherInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayDuoProSlot implements ObserverInterface, SlotDuoWeatherInterface
{
    private Observable $weatherDataIn;
    private Observable $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    private InfoFormatterInterface $formatter;
    private InfoFormatterInterface $formatterPro;

    public function __construct(Observable $weatherDataIn, Observable $weatherDataOut)
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

    public function setFormatterPro(InfoFormatterInterface $formatterPro) : void
    {
        $this->formatterPro = $formatterPro;
        $this->outIndicator->setFormatter($this->formatterPro);
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