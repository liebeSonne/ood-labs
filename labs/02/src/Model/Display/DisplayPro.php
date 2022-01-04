<?php

namespace App\Model\Display;

use App\Observer\ObserverInterface;

class DisplayPro implements ObserverInterface
{
    public function update(\StdClass $data) : void
    {
        echo "Current Temp " . $data->temperature . "\n";
        echo "Current Hum  " . $data->humidity . "\n";
        echo "Current Pressure  " . $data->pressure . "\n";
        echo "Current Wind Speed  " . $data->windSpeed . "\n";
        echo "Current Wind Direction  " . $data->windDirection . "\n";
        echo "----------------\n";
    }
}