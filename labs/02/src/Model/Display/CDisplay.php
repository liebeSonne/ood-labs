<?php

namespace App\Model\Display;

use App\Observer\IObserver;

class CDisplay implements IObserver
{
    public function Update(\StdClass $data) : void
    {
        echo "Current Temp " . $data->temperature . "\n";
        echo "Current Hum  " . $data->humidity . "\n";
        echo "Current Pressure  " . $data->pressure . "\n";
        echo "----------------\n";
    }
}