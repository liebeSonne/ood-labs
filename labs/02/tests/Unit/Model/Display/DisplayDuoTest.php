<?php

namespace Tests\Unit\Model\Display;

use App\Model\Display\DisplayDuo;
use App\Model\Weather\WeatherData;
use App\Model\Weather\WeatherInfo;
use PHPUnit\Framework\TestCase;

class DisplayDuoTest extends TestCase
{
    public function testDisplayDuoInOut() : void
    {
        $in = new WeatherData();
        $out = new WeatherData();

        $display = $this->getMockBuilder(DisplayDuo::class)
            ->setConstructorArgs([$in, $out])
            ->getMock();

        $display->expects($this->exactly(2))
            ->method('update')
            ->withConsecutive(
                [
                    $this->isInstanceOf(WeatherInfo::class),
                    $this->callback(function($subject) use ($in) {
                        return $subject === $in;
                    })
                ],
                [
                    $this->isInstanceOf(WeatherInfo::class),
                    $this->callback(function($subject) use ($out) {
                        return $subject === $out;
                    })
                ]
            );

        $in->registerObserver($display);
        $out->registerObserver($display);

        $in->notifyObservers();
        $out->notifyObservers();
    }
}