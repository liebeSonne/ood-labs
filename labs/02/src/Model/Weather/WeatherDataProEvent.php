<?php

namespace App\Model\Weather;

use App\Event\EventManager;
use App\Event\EventManagerInterface;

class WeatherDataProEvent extends EventManager implements EventManagerInterface
{
    private float $temperature = 0.0;
    private float $humidity = 0.0;
    private float $pressure = 760.0;
    public float $windSpeed = 0;
    public int $windDirection = 0;

    private string $type;

    const EVENT_ALL = '*';
    const EVENT_TEMP = 'temp';
    const EVENT_HUMIDITY = 'humidity';
    const EVENT_PRESSURE = 'pressure';
    const EVENT_WIND_SPEED = 'wind_speed';
    const EVENT_WIND_DIRECTION = 'wind_direction';

    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    public function getType() : string
    {
        return $this->type;
    }

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
        $data = $this->getChangedData();
        $this->notifyEventListener(self::EVENT_ALL, $data);
    }

    public function setMeasurements(float $temp, float $humidity, float $pressure, float $windSpeed, int $windDirection) : void
    {
        $events = [];
        if ($this->temperature !== $temp)
        {
            $events[self::EVENT_TEMP] = $temp;
        }
        if ($this->humidity !== $humidity)
        {
            $events[self::EVENT_HUMIDITY] = $humidity;
        }
        if ($this->pressure !== $pressure)
        {
            $events[self::EVENT_PRESSURE] = $pressure;
        }
        if ($this->windSpeed !== $windSpeed)
        {
            $events[self::EVENT_WIND_SPEED] = $windSpeed;
        }
        if ($this->windDirection !== $windDirection)
        {
            $events[self::EVENT_WIND_DIRECTION] = $windDirection;
        }

        $this->humidity = $humidity;
        $this->temperature = $temp;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;

        $this->measurementsChanged();

        foreach ($events as $event => $data)
        {
            $this->notifyEventListener($event, $data);
        }
    }

    protected function getChangedData() : \StdClass
    {
        $info = new WeatherInfoPro();
        $info->temperature = $this->getTemperature();
        $info->humidity = $this->getHumidity();
        $info->pressure = $this->getPressure();
        $info->windSpeed = $this->getWindSpeed();
        $info->windDirection = $this->getWindDirection();
        $info->type = $this->getType();
        return $info;
    }
}