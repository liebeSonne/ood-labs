<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\CWeatherData;
use App\Model\Display\CDisplay;
use App\Model\Display\CStatsDisplay;

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