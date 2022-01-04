<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\WeatherDataProEvent;
use App\Model\Display\DisplayProEvent;
use App\Model\Display\StatsDisplayProEvent;

function main() : void
{
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    echo "\n~~ Weather Station Pro Event ~~\n";
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

    $wd = new WeatherDataProEvent();

    $display = new DisplayProEvent();
    $wd->addEventListener($display, [
        WeatherDataProEvent::EVENT_TEMP,
        WeatherDataProEvent::EVENT_HUMIDITY,
        WeatherDataProEvent::EVENT_PRESSURE,
        //WeatherDataProEvent::EVENT_WIND_SPEED,
        //WeatherDataProEvent::EVENT_WIND_DIRECTION,
    ]);

    $statsDisplay = new StatsDisplayProEvent();
    $wd->addEventListener($statsDisplay, [
        WeatherDataProEvent::EVENT_TEMP,
        WeatherDataProEvent::EVENT_HUMIDITY,
        WeatherDataProEvent::EVENT_PRESSURE,
        //WeatherDataProEvent::EVENT_WIND_SPEED,
        //WeatherDataProEvent::EVENT_WIND_DIRECTION,
    ]);

    $wd->setMeasurements(3, 0.7, 760, 12, 90);
    $wd->setMeasurements(4, 0.8, 761, 15, 86);

    //$wd->removeObserver($statsDisplay);

    $wd->setMeasurements(10,0.8,761, 23, 180);
    $wd->setMeasurements(-10,0.8,761, 25, 270);

}

main();