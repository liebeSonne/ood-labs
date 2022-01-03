<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\WeatherData;
use App\Model\Display\DisplayDuo;
use App\Model\Display\StatsDisplayDuo;

function main() : void
{
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    echo "\n~~ Weather Station Duo ~~\n";
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~\n";

    $wdIn = new WeatherData('in');
    $wdOut = new WeatherData('out');

    $display = new DisplayDuo();
    $wdIn->registerObserver($display);
    $wdOut->registerObserver($display);

    $statsDisplay = new StatsDisplayDuo();
    $wdIn->registerObserver($statsDisplay);
    $wdOut->registerObserver($statsDisplay);

    $wdOut->setMeasurements(3, 0.7, 760);
    $wdOut->setMeasurements(4, 0.8, 761);

    $wdIn->setMeasurements(14, 0.3, 700);
    $wdIn->setMeasurements(18, 0.4, 710);

    $wdOut->removeObserver($statsDisplay);

    $wdOut->setMeasurements(10,0.8,761);
    $wdOut->setMeasurements(-10,0.8,761);

}

main();