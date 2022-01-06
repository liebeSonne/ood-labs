<?php

//namespace Tests\Unit\Model\Weather;
//
//use App\Model\Weather\WeatherDataSignal;
//use PHPUnit\Framework\TestCase;
//
//class WeatherDataSignalTest extends TestCase
//{
//    public function testSetMeasurements()
//    {
//        $weather = $this->createMock(WeatherDataSignal::class);
//
//        $weather->expects($this->exactly(3))->method('emit')->withConsecutive(
//            [$this->equalTo('temp'), $this->greaterThan(0)],
//            [$this->equalTo('humidity'), $this->greaterThan(0)],
//            [$this->equalTo('pressure'), $this->greaterThan(0)],
//        );
//
//        $weather->setMeasurements(5, 10, 20);
//    }
//}