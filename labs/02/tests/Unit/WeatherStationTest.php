<?php

namespace Tests\Unit;

use App\Observer\Observable;
use App\Observer\ObserverInterface;
use PHPUnit\Framework\TestCase;

class WeatherStationTest extends TestCase
{
    public function testRemoveOnUpdateInNotifyObservers() : void
    {
        $observable = $this->createMock(Observable::class);

        $observer = $this->createMock(ObserverInterface::class);
        $observer->method('update')->will($this->returnCallback(
            function() use($observable, $observer) {
                $observable->removeObserver($observer);
            }
        ));

        $observable->registerObserver($observer);
        $observable->notifyObservers();

        $this->assertTrue(true);
    }

}