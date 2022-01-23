<?php

namespace App\Model\Weather;

use App\Observer\Observable;
use Fluffy\Connector\Signal\SignalInterface;
use Fluffy\Connector\Signal\SignalTrait;

class WeatherDataSignal extends Observable implements SignalInterface
{
    use SignalTrait;

    private float $temperature = 0.0;
    private float $humidity = 0.0;
    private float $pressure = 760.0;

    public function getTemperature() : float
    {
        return $this->temperature;
    }

    public function getHumidity() : float
    {
        return $this->humidity;
    }

    public function getPressure() : float
    {
        return $this->pressure;
    }

    public function measurementsChanged() : void
    {
        $this->notifyObservers();
    }

    public function setMeasurements(float $temp, float $humidity, float $pressure) : void
    {
        $this->humidity = $humidity;
        $this->temperature = $temp;
        $this->pressure = $pressure;

        $this->measurementsChanged();

        $this->emit('temp', $this->temperature);
        $this->emit('humidity', $this->humidity);
        $this->emit('pressure', $this->pressure);
    }

    protected function getChangedData() : \StdClass
    {
        $info = new WeatherInfo();
        $info->temperature = $this->getTemperature();
        $info->humidity = $this->getHumidity();
        $info->pressure = $this->getPressure();
        return $info;
    }
}