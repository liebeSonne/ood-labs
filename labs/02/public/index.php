<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\WeatherData;
use App\Model\Display\Display;
use App\Model\Display\StatsDisplay;

function main() : void
{
    echo "\n~~~~~~~~~~~~~~~~~~~~~\n";
    echo "\n~~ Weather Station ~~\n";
    echo "\n~~~~~~~~~~~~~~~~~~~~~\n";

    $wd = new WeatherData();

    $display = new Display();
    $wd->registerObserver($display);

    $statsDisplay = new StatsDisplay();
    $wd->registerObserver($statsDisplay);

    $wd->setMeasurements(3, 0.7, 760);
    $wd->setMeasurements(4, 0.8, 761);

    $wd->removeObserver($statsDisplay);

    $wd->setMeasurements(10,0.8,761);
    $wd->setMeasurements(-10,0.8,761);

}

main();