<?php

namespace App\Model\Display\Indicator;

class CurrentIndicatorPro implements IndicatorInterface
{
    private \StdClass $data;

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->data = new \StdClass();
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
    }

    public function display() : void
    {
        echo "-[" . $this->name . "]: \n";
        echo "Current Temp " . $this->data->temperature . "\n";
        echo "Current Hum  " . $this->data->humidity . "\n";
        echo "Current Pressure  " . $this->data->pressure . "\n";
        echo "Current Wind Speed  " . $this->data->windSpeed . "\n";
        echo "Current Wind Direction  " . $this->data->windDirection . "\n";
    }
}