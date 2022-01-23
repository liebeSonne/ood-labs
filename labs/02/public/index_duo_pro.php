<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\WeatherData;
use App\Model\Weather\WeatherDataPro;
use App\Model\Display\DisplayDuoPro;
use App\Model\Display\StatsDisplayDuoPro;

function main() : void
{
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    echo "\n~~ Weather Station Duo Pro ~~\n";
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

    $wdIn = new WeatherData();
    $wdOut = new WeatherDataPro();

    $display = new DisplayDuoPro($wdIn, $wdOut);
    $wdIn->registerObserver($display);
    $wdOut->registerObserver($display);

    $statsDisplay = new StatsDisplayDuoPro($wdIn, $wdOut);
    $wdIn->registerObserver($statsDisplay);
    $wdOut->registerObserver($statsDisplay);

    $wdOut->setMeasurements(3, 0.7, 760, 12, 90);
    $wdOut->setMeasurements(4, 0.8, 761, 15, 86);

    $wdIn->setMeasurements(14, 0.3, 700);
    $wdIn->setMeasurements(18, 0.4, 710);

    //$wdOut->removeObserver($statsDisplay);

    $wdOut->setMeasurements(10,0.8,761, 22,270);
    $wdOut->setMeasurements(-10,0.8,761, 25, 180);

}

main();