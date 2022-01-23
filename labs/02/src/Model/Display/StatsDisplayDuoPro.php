<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\StatIndicator;
use App\Model\Display\Indicator\StatIndicatorPro;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplayDuoPro implements ObserverInterface
{
    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    public function __construct()
    {
        $this->inIndicator = new StatIndicator('In');
        $this->outIndicator = new StatIndicatorPro('Out');
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

    public function display() : void
    {
        echo "================\n";
        $this->inIndicator->display();
        $this->outIndicator->display();
        echo "================\n";
    }
}
