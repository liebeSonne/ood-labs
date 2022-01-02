<?php

namespace App\Model\Display;

use App\Observer\ObserverInterface;

class StatsDisplay implements ObserverInterface
{
    private float $minTemperature = PHP_FLOAT_MAX;
    private float $maxTemperature = PHP_FLOAT_MIN;
    private float $accTemperature = 0;
    private int $countAcc = 0;

    public function update(\StdClass $data) : void
    {
        if ($this->minTemperature > $data->temperature) {
            $this->minTemperature = $data->temperature;
        }
        if ($this->maxTemperature < $data->temperature) {
            $this->maxTemperature = $data->temperature;
        }

        $this->accTemperature += $data->temperature;
        ++$this->countAcc;

        echo "Max Temp " . $this->maxTemperature . "\n";
        echo "Min Temp  " . $this->minTemperature . "\n";
        echo "Average Temp  " . $this->accTemperature . "\n";
        echo "----------------\n";
    }
}