<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentIndicator;
use App\Model\Display\Indicator\CurrentIndicatorPro;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayDuoPro implements ObserverInterface
{
    private Observable $weatherDataIn;
    private Observable $weatherDataOut;

    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    public function __construct(Observable $weatherDataIn, Observable $weatherDataOut)
    {
        $this->weatherDataIn = $weatherDataIn;
        $this->weatherDataOut = $weatherDataOut;

        $this->inIndicator = new CurrentIndicator('In');
        $this->outIndicator = new CurrentIndicatorPro('Out');
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