<?php

namespace App\Model\Display;

use App\Observer\Observable;
use App\Observer\ObserverInterface;

class Display implements ObserverInterface
{
    public function update(\StdClass $data, Observable $subject) : void
    {
        echo "Current Temp " . $data->temperature . "\n";
        echo "Current Hum  " . $data->humidity . "\n";
        echo "Current Pressure  " . $data->pressure . "\n";
        echo "----------------\n";
    }
}