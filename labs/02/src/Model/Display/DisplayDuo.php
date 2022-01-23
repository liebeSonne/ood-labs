<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\CurrentIndicator;
use App\Model\Display\Indicator\IndicatorInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayDuo implements ObserverInterface
{
    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    public function __construct()
    {
        $this->inIndicator = new CurrentIndicator('In');
        $this->outIndicator = new CurrentIndicator('Out');
    }

    public function update(\StdClass $data, Observable $subject) : void
    {
        if ($data->type == 'in')
        {
            $this->inIndicator->setData($data);
        }
        if ($data->type == 'out')
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