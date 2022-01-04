<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\WeatherDataPro;
use App\Model\Display\DisplayPro;
use App\Model\Display\StatsDisplayPro;

function main() : void
{
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    echo "\n~~ Weather Station Pro ~~\n";
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~\n";

    $wd = new WeatherDataPro();

    $display = new DisplayPro();
    $wd->registerObserver($display);

    $statsDisplay = new StatsDisplayPro();
    $wd->registerObserver($statsDisplay);

    $wd->setMeasurements(3, 0.7, 760, 12, 90);
    $wd->setMeasurements(4, 0.8, 761, 15, 86);

    //$wd->removeObserver($statsDisplay);

    $wd->setMeasurements(10,0.8,761, 23, 180);
    $wd->setMeasurements(-10,0.8,761, 25, 270);

}

main();