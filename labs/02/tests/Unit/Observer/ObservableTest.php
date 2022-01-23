<?php

namespace Tests\Unit\Observable;

use App\Model\Weather\WeatherData;
use App\Observer\ObserverInterface;
use PHPUnit\Framework\TestCase;

class ObservableTest extends TestCase
{
    public function testPriorityRegistration() : void
    {
        $observable = new WeatherData();

        $observer1 = $this->createMock(ObserverInterface::class);
        $observer2 = $this->createMock(ObserverInterface::class);
        $observer3 = $this->createMock(ObserverInterface::class);

        $observer1->method('update')->will($this->returnCallback(function () { echo '1'; }));
        $observer2->method('update')->will($this->returnCallback(function () { echo '2'; }));
        $observer3->method('update')->will($this->returnCallback(function () { echo '3'; }));

        $observable->registerObserver($observer1, 10);
        $observable->registerObserver($observer2, 0);
        $observable->registerObserver($observer3, 5);

        $observer1->expects($this->once())->method('update');
        $observer2->expects($this->once())->method('update');
        $observer3->expects($this->once())->method('update');

        $this->expectOutputString('132');

        $observable->notifyObservers();
    }
}