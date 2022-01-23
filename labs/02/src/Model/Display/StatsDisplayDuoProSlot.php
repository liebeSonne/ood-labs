<?php

namespace App\Model\Display;

use App\Model\Display\Indicator\IndicatorInterface;
use App\Model\Display\Indicator\StatWeatherIndicatorPro;
use App\Model\Display\Indicator\StatWeatherIndicator;
use App\Model\Display\Slot\SlotDuoWeatherInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class StatsDisplayDuoProSlot implements ObserverInterface, SlotDuoWeatherInterface
{
    private IndicatorInterface $inIndicator;
    private IndicatorInterface $outIndicator;

    public function __construct()
    {
        $this->inIndicator = new StatWeatherIndicator('In');
        $this->outIndicator = new StatWeatherIndicatorPro('Out');
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
