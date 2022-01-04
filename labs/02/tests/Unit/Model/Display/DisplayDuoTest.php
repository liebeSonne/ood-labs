<?php

namespace Tests\Unit\Model\Display;

use App\Model\Display\DisplayDuo;
use App\Model\Weather\WeatherData;
use PHPUnit\Framework\TestCase;

class DisplayDuoTest extends TestCase
{
    public function testDisplayDuoInOut() : void
    {
        $in = new WeatherData('in');
        $out = new WeatherData('out');

        $display = $this->createMock(DisplayDuo::class);
        $display->method('update')->will($this->returnArgument(0));
        $display->expects($this->exactly(2))->method('update')->withConsecutive(
            [$this->callback(function($data){
                return $data->type === 'in';
            })],
            [$this->callback(function($data){
                return $data->type === 'out';
            })]
        );

        $in->registerObserver($display);
        $out->registerObserver($display);

        $in->notifyObservers();
        $out->notifyObservers();
    }
}