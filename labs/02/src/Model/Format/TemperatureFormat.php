<?php

namespace App\Model\Format;

class TemperatureFormat
{
    public const FAHRENHEIT = '°F';
    public const CELSIUS = '°C';

    /**
     * From Celsius to Fahrenheit
     * @param float $value
     * @return float
     */
    public static function toFahrenheit(float $value): float
    {
        return $value * 9 / 5 + 32;
    }

    /**
     * From Fahrenheit to Celsius
     * @param float $value
     * @return float
     */
    public static function toCelsius(float $value): float
    {
        return ($value - 32) * 5 / 9;
    }
}