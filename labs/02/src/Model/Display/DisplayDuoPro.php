<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentIndicator;
use App\Model\Display\Indicator\CurrentIndicatorPro;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\DefaultInfoProFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayDuoPro implements ObserverInterface
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
}