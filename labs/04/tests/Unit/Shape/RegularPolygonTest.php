<?php

namespace Tests\Unit\Shape;

use App\Canvas\CanvasInterface;
use App\Common\Color;
use App\Common\Point;
use App\Shape\RegularPolygon;
use PHPUnit\Framework\TestCase;

class RegularPolygonTest extends TestCase
{
    public function testGetters(): void
    {
        $center = $this->createMock(Point::class);
        $radius = 5.5;
        $countVertex = 10;
        $color = Color::YELLOW;

        $shape = new RegularPolygon($center, $radius, $countVertex, $color);

        $this->assertEquals($center, $shape->getCenter());
        $this->assertEquals($radius, $shape->getRadius());
        $this->assertEquals($countVertex, $shape->getVertexCount());
        $this->assertEquals($color, $shape->getColor());
    }

    public function testDraw(): void
    {
        $canvas = $this->createMock(CanvasInterface::class);
        $center = $this->createMock(Point::class);
        $radius = 5.5;
        $countVertex = 10;
        $color = Color::YELLOW;

        $shape = new RegularPolygon($center, $radius, $countVertex, $color);

        $canvas->expects($this->once())->method('setColor');
        $canvas->expects($this->exactly($countVertex))->method('drawLine');

        $shape->draw($canvas);
    }
}
