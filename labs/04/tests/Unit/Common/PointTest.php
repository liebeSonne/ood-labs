<?php

namespace Tests\Unit\Common;

use App\Common\Point;
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
}