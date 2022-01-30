<?php

namespace Tests\Unit\Factory;

use App\Factory\ShapeFactory;
use App\Shape\Ellipse;
use App\Shape\Rectangle;
use App\Shape\RegularPolygon;
use App\Shape\Triangle;
use PHPUnit\Framework\TestCase;

class ShapeFactoryTest extends TestCase
{
    public function testCreateShape(): void
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape('ellipse 0 0 10 5 red');
        $this->assertInstanceOf(Ellipse::class, $shape);

        $shape = $factory->createShape('triangle 0 0 10 10 20 20 yellow');
        $this->assertInstanceOf(Triangle::class, $shape);

        $shape = $factory->createShape('rectangle 0 0 10 10 blue');
        $this->assertInstanceOf(Rectangle::class, $shape);

        $shape = $factory->createShape('polygon 0 0 10 5 white');
        $this->assertInstanceOf(RegularPolygon::class, $shape);

        $shape = $factory->createShape('not a shape');
        $this->assertNull($shape);
    }
}