<?php

namespace Tests\Unit\Shape;

use App\Canvas\CanvasInterface;
use App\Color;
use App\Point;
use App\Shape\Rectangle;
use PHPUnit\Framework\TestCase;

class RectangleTest extends TestCase
{
    public function testGetters(): void
    {
        $leftTop = $this->createMock(Point::class);
        $rightBottom = $this->createMock(Point::class);
        $color = Color::PINK;

        $shape = new Rectangle($leftTop, $rightBottom, $color);

        $this->assertEquals($leftTop, $shape->getLeftTop());
        $this->assertEquals($rightBottom, $shape->getRightBottom());
        $this->assertEquals($color, $shape->getColor());
    }

    public function testDraw(): void
    {
        $canvas = $this->createMock(CanvasInterface::class);
        $leftTop = $this->createMock(Point::class);
        $rightBottom = $this->createMock(Point::class);
        $color = Color::PINK;

        $shape = new Rectangle($leftTop, $rightBottom, $color);

        $canvas->expects($this->once())->method('setColor');
        $canvas->expects($this->exactly(4))->method('drawLine');

        $shape->draw($canvas);
    }
}