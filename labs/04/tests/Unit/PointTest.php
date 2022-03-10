<?php

namespace Tests\Unit;

use App\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testGetters(): void
    {
        $x = 10.1;
        $y = 11.2;

        $point = new Point($x, $y);

        $this->assertEquals($x, $point->getX());
        $this->assertEquals($y, $point->getY());
    }

    public function testSetters(): void
    {
        $x = 10.1;
        $y = 11.2;
        $newX = 7.2;
        $newY = 6.6;

        $point = new Point($x, $y);

        $this->assertEquals($newX, $point->getX());
        $this->assertEquals($newY, $point->getY());
    }
}