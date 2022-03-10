<?php

namespace Tests\Unit\Shape;

use App\Common\Color;
use App\Common\Point;
use App\Shape\Ellipse;
use App\Canvas\CanvasInterface;
use PHPUnit\Framework\TestCase;

class EllipseTest extends TestCase
{
    public function testGetters(): void
    {
        $point = $this->createMock(Point::class);

        $center = $point;
        $hRadius = 10.2;
        $vRadius = 15.5;
        $color = Color::BLUE;

        $shape = new Ellipse($center, $hRadius, $vRadius, $color);

        $this->assertEquals($center, $shape->getCenter());
        $this->assertEquals($hRadius, $shape->getHorizontalRadius());
        $this->assertEquals($vRadius, $shape->getVerticalRadius());
        $this->assertEquals($color, $shape->getColor());
    }

    public function testDraw(): void
    {
        $canvas = $this->createMock(CanvasInterface::class);
        $point = $this->createMock(Point::class);

        $center = $point;
        $hRadius = 10.2;
        $vRadius = 15.5;
        $color = Color::BLUE;

        $shape = new Ellipse($center, $hRadius, $vRadius, $color);

        $canvas->expects($this->once())->method('setColor');
        $canvas->expects($this->once())->method('drawEllipse');

        $shape->draw($canvas);
    }
}