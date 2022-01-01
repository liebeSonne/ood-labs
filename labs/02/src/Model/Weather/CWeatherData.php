<?php

namespace App\Model\Weather;

use App\Observable\CObservable;

class CWeatherData extends CObservable
{
    private float $m_temperature = 0.0;
    private float $m_humidity = 0.0;
    private float $m_pressure = 760.0;

    public function GetTemperature() : float
    {
        return $this->m_temperature;
    }

    public function GetHumidity() : float
    {
        return $this->m_humidity;
    }

    public function GetPressure() : float
    {
        return $this->m_pressure;
    }

    public function MeasurementsChanged() : void
    {
        $this->NotifyObservers();
    }

    public function SetMeasurements(float $temp, float $humidity, float $pressure) : void
    {
        $this->m_humidity = $humidity;
        $this->m_temperature = $temp;
        $this->m_pressure = $pressure;

        $this->MeasurementsChanged();
    }

    protected function GetChangedData() : \StdClass
    {
        $info = new SWeatherInfo();
        $info->temperature = $this->GetTemperature();
        $info->humidity = $this->GetHumidity();
        $info->pressure = $this->GetPressure();
        return $info;
    }
}