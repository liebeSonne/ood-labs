<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Weather\WeatherDataSignal;
use App\Model\Weather\WeatherDataProSignal;
use App\Model\Display\DisplayDuoProSlot;
use App\Model\Display\StatsDisplayDuoPro;
use Fluffy\Connector\ConnectionManager;

function main() : void
{
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    echo "\n~~ Weather Station Duo Pro Signal ~~\n";
    echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

    $wdIn = new WeatherDataSignal('in');
    $wdOut = new WeatherDataProSignal('out');

    $display = new DisplayDuoProSlot();

    ConnectionManager::connect($wdIn, 'temp', $display, 'slotInTemp');
    ConnectionManager::connect($wdIn, 'humidity', $display, 'slotInHumidity');
    ConnectionManager::connect($wdIn, 'pressure', $display, 'slotInPressure');

    ConnectionManager::connect($wdOut, 'temp', $display, 'slotOutTemp');
    ConnectionManager::connect($wdOut, 'humidity', $display, 'slotOutHumidity');
    ConnectionManager::connect($wdOut, 'pressure', $display, 'slotOutPressure');
    ConnectionManager::connect($wdOut, 'windSpeed', $display, 'slotOutWindSpeed');
    ConnectionManager::connect($wdOut, 'windDirection', $display, 'slotOutWindDirection');

    $statsDisplay = new StatsDisplayDuoPro();

    ConnectionManager::connect($wdIn, 'temp', $statsDisplay, 'slotInTemp');
    ConnectionManager::connect($wdIn, 'humidity', $statsDisplay, 'slotInHumidity');
    ConnectionManager::connect($wdIn, 'pressure', $statsDisplay, 'slotInPressure');

    ConnectionManager::connect($wdOut, 'temp', $statsDisplay, 'slotOutTemp');
    ConnectionManager::connect($wdOut, 'humidity', $statsDisplay, 'slotOutHumidity');
    ConnectionManager::connect($wdOut, 'pressure', $statsDisplay, 'slotOutPressure');
    ConnectionManager::connect($wdOut, 'windSpeed', $statsDisplay, 'slotOutWindSpeed');
    ConnectionManager::connect($wdOut, 'windDirection', $statsDisplay, 'slotOutWindDirection');

    $wdOut->setMeasurements(3, 0.7, 760, 12, 90);
    $wdOut->setMeasurements(4, 0.8, 761, 15, 86);

    $wdIn->setMeasurements(14, 0.3, 700);
    $wdIn->setMeasurements(18, 0.4, 710);

    $wdOut->setMeasurements(10,0.8,761, 22,270);
    $wdOut->setMeasurements(-10,0.8,761, 25, 180);

}

main();