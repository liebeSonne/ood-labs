<?php

namespace App\Model\Display;

use App\Observer\IObserver;

class CStatsDisplay implements IObserver
{
    private float $m_minTemperature = PHP_FLOAT_MAX;
    private float $m_maxTemperature = PHP_FLOAT_MIN;
    private float $m_accTemperature = 0;
    private int $m_countAcc = 0;

    public function Update(\StdClass $data) : void
    {
        if ($this->m_minTemperature > $data->temperature) {
            $this->m_minTemperature = $data->temperature;
        }
        if ($this->m_maxTemperature < $data->temperature) {
            $this->m_maxTemperature = $data->temperature;
        }

        $this->m_accTemperature += $data->temperature;
        ++$this->m_countAcc;

        echo "Max Temp " . $this->m_maxTemperature . "\n";
        echo "Min Temp  " . $this->m_minTemperature . "\n";
        echo "Average Temp  " . $this->m_accTemperature . "\n";
        echo "----------------\n";
    }
}