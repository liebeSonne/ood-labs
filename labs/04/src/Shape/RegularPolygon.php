<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Common\Color;
use App\Common\Point;

class RegularPolygon extends Shape
{
    private int $countVertex;
    private Point $center;
    private float $radius;

    public function __construct(Point $center, float $radius, int $countVertex, string $color = Color::BLACK)
    {
        $this->center = $center;
        $this->radius = $radius;
        $this->countVertex = $countVertex;
        $this->setColor($color);
    }

    public function getVertexCount() : int
    {
        return $this->countVertex;
    }

    public function getCenter() : Point
    {
        return $this->center;
    }

    public function getRadius() : float
    {
        return $this->radius;
    }

    public function draw(CanvasInterface $canvas) : void
    {
        $n = $this->countVertex;
        $x0 = $this->center->getX();
        $y0 = $this->center->getY();
        $r = $this->radius;
        $points = [];
        for($i = 0; $i < $n; $i++) {
            $x = $x0 + $r * cos(2 * M_PI * $i / $n);
            $y = $y0 + $r * sin(2 * M_PI * $i / $n);
            $points[] = new Point($x, $y);
        }

        $color = $this->getColor();
        $canvas->setColor($color);
        for($i = 0; $i < $n; $i++) {
            $p1 = $points[$i];
            $p2 = ($i == $n - 1) ? $points[0] : $points[$i+1];
            $canvas->drawLine($p1, $p2);
        }
    }
}