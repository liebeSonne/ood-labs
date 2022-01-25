<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentIndicator;
use App\Model\Display\Indicator\CurrentIndicatorPro;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\IndicatorProInterface;
use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\DefaultInfoProFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Model\Display\Info\Formatter\InfoProFormatterInterface;
use App\Model\Weather\WeatherInfo;
use App\Model\Weather\WeatherInfoPro;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayDuoPro implements ObserverInterface
{
    private Observable $weatherDataIn;
    private Observable $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorProInterface $outIndicator;

    private InfoFormatterInterface $formatter;
    private InfoProFormatterInterface $formatterPro;

    public function __construct(Observable $weatherDataIn, Observable $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $formatter = new DefaultInfoFormatter();
        $formatterPro = new DefaultInfoProFormatter();

        $this->inIndicator = new CurrentIndicator('In', $formatter);
        $this->outIndicator = new CurrentIndicatorPro('Out', $formatterPro);

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

    public function update(\StdClass $data, Observable $subject) : void
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
}