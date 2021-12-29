<?php

interface IObserver
{
    public function Update(\StdClass $data) : void;
}

interface IObservable
{
    public function RegisterObserver(IObserver $observer) : void;
    public function NotifyObservers() : void;
    public function RemoveObserver(IObserver $observer) : void;
}

abstract class CObservable implements IObservable
{
    protected SplObjectStorage $m_observers;

    public function __construct()
    {
        $this->m_observers = new SplObjectStorage();
    }

    public function RegisterObserver(IObserver $observer) : void
    {
        $this->m_observers->attach($observer);
    }

    public function NotifyObservers() :void
    {
        $data = $this->GetChangedData();

        foreach ($this->m_observers as $observer) {
            $observer->Update($data);
        }
    }

    public function RemoveObserver(IObserver $observer) : void
    {
        $this->m_observers->detach($observer);
    }

    abstract protected function GetChangedData() : \StdClass;
}

class SWeatherInfo extends \StdClass
{
    public float $temperature = 0;
    public float $humidity = 0;
    public float $pressure = 0;
}

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


function main() : void
{
    $wd = new CWeatherData();

    $display = new CDisplay();
    $wd->RegisterObserver($display);

    $statsDisplay = new CStatsDisplay();
    $wd->RegisterObserver($statsDisplay);

    $wd->SetMeasurements(3, 0.7, 760);
    $wd->SetMeasurements(4, 0.8, 761);

    $wd->RemoveObserver($statsDisplay);

    $wd->SetMeasurements(10,0.8,761);
    $wd->SetMeasurements(-10,0.8,761);

}

main();
