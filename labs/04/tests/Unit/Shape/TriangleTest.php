<?php

namespace Tests\Unit\Shape;

use App\Canvas\CanvasInterface;
use App\Color;
use App\Point;
use App\Shape\Triangle;
use PHPUnit\Framework\TestCase;

class TriangleTest extends TestCase
{
    public function testGetters(): void
    {
        $vertex1 = $this->createMock(Point::class);
        $vertex2 = $this->createMock(Point::class);
        $vertex3 = $this->createMock(Point::class);
        $color = Color::YELLOW;

        $shape = new Triangle($vertex1, $vertex2, $vertex3, $color);

        $this->assertEquals($vertex1, $shape->getVertex1());
        $this->assertEquals($vertex2, $shape->getVertex2());
        $this->assertEquals($vertex3, $shape->getVertex3());
    }

    public function testDraw(): void
    {
        $canvas = $this->createMock(CanvasInterface::class);
        $vertex1 = $this->createMock(Point::class);
        $vertex2 = $this->createMock(Point::class);
        $vertex3 = $this->createMock(Point::class);
        $color = Color::YELLOW;

        $shape = new Triangle($vertex1, $vertex2, $vertex3, $color);

        $canvas->expects($this->once())->method('setColor');
        $canvas->expects($this->exactly(3))->method('drawLine');

        $shape->draw($canvas);
    }
}
