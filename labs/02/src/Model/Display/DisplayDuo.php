<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentIndicator;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayDuo implements ObserverInterface
{
    private Observable $weatherDataIn;
    private Observable $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    private InfoFormatterInterface $formatter;

    public function __construct(Observable $weatherDataIn, Observable $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $formatter = new DefaultInfoFormatter();

        $this->inIndicator = new CurrentIndicator('In', $formatter);
        $this->outIndicator = new CurrentIndicator('Out', $formatter);

        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
        $this->inIndicator->setFormatter($this->formatter);
        $this->outIndicator->setFormatter($this->formatter);
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