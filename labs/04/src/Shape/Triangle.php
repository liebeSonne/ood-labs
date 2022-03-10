<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Common\Color;
use App\Common\Point;

class Triangle extends Shape
{
    private Point $vertex1;
    private Point $vertex2;
    private Point $vertex3;

    public function __construct(Point $vertex1, Point $vertex2, Point $vertex3, string $color = Color::BLACK)
    {
        $this->vertex1 = $vertex1;
        $this->vertex2 = $vertex2;
        $this->vertex3 = $vertex3;
        $this->setColor($color);
    }

    public function getVertex1() : Point
    {
        return $this->vertex1;
    }

    public function getVertex2() : Point
    {
        return $this->vertex2;
    }

    public function getVertex3() : Point
    {
        return $this->vertex3;
    }

    public function draw(CanvasInterface $canvas) : void
    {
        $p1 = $this->getVertex1();
        $p2 = $this->getVertex2();
        $p3 = $this->getVertex3();
        $color = $this->getColor();
        $canvas->setColor($color);
        $canvas->drawLine($p1, $p2);
        $canvas->drawLine($p2, $p3);
        $canvas->drawLine($p3, $p1);
    }
}