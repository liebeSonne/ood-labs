<?php

namespace App\Model\Weather;

use App\Observer\Observable;

class WeatherDataPro extends Observable
{
    private float $temperature = 0.0;
    private float $humidity = 0.0;
    private float $pressure = 760.0;
    public float $windSpeed = 0;
    public int $windDirection = 0;

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

    public function getWindSpeed() : float
    {
        return $this->windSpeed;
    }

    public function getWindDirection() : int
    {
        return $this->windDirection;
    }

    public function measurementsChanged() : void
    {
        $this->notifyObservers();
    }

    public function setMeasurements(float $temp, float $humidity, float $pressure, float $windSpeed, int $windDirection) : void
    {
        $this->humidity = $humidity;
        $this->temperature = $temp;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;

        $this->measurementsChanged();
    }

    protected function getChangedData() : \StdClass
    {
        $info = new WeatherInfoPro();
        $info->temperature = $this->getTemperature();
        $info->humidity = $this->getHumidity();
        $info->pressure = $this->getPressure();
        $info->windSpeed = $this->getWindSpeed();
        $info->windDirection = $this->getWindDirection();
        return $info;
    }
}