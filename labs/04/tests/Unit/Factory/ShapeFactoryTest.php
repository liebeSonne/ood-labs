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

    public function testCreateShapeEllipse(): void
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape('ellipse 0 0 10 5 red');

        $this->assertInstanceOf(Ellipse::class, $shape);
        $this->assertEquals(0, $shape->getCenter()->getX());
        $this->assertEquals(0, $shape->getCenter()->getY());
        $this->assertEquals(10, $shape->getHorizontalRadius());
        $this->assertEquals(5, $shape->getVerticalRadius());
        $this->assertEquals('red', $shape->getColor());
    }

    public function testCreateShapeTriangle(): void
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape('triangle 0 0 10 10 20 20 yellow');

        $this->assertInstanceOf(Triangle::class, $shape);
        $this->assertEquals(0, $shape->getVertex1()->getX());
        $this->assertEquals(0, $shape->getVertex1()->getY());
        $this->assertEquals(10, $shape->getVertex2()->getX());
        $this->assertEquals(10, $shape->getVertex2()->getY());
        $this->assertEquals(20, $shape->getVertex3()->getX());
        $this->assertEquals(20, $shape->getVertex3()->getY());
        $this->assertEquals('yellow', $shape->getColor());
    }

    public function testCreateShapeRectangle(): void
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape('rectangle 0 0 10 10 blue');

        $this->assertInstanceOf(Rectangle::class, $shape);
        $this->assertEquals(0, $shape->getLeftTop()->getX());
        $this->assertEquals(0, $shape->getLeftTop()->getY());
        $this->assertEquals(10, $shape->getRightBottom()->getX());
        $this->assertEquals(10, $shape->getRightBottom()->getY());
        $this->assertEquals('blue', $shape->getColor());
    }


    public function testCreateShapeRegularPolygon(): void
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape('polygon 0 0 10 5 white');
        $this->assertInstanceOf(RegularPolygon::class, $shape);
        $this->assertEquals(0, $shape->getCenter()->getX());
        $this->assertEquals(0, $shape->getCenter()->getY());
        $this->assertEquals(10, $shape->getRadius());
        $this->assertEquals(5, $shape->getVertexCount());
        $this->assertEquals('white', $shape->getColor());
    }

    public function testCreateShapeNull(): void
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape('not a shape');

        $this->assertNull($shape);
    }
}