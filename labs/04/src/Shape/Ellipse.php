<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Common\Color;
use App\Common\Point;

class Ellipse extends Shape
{
    private Point $center;
    private float $hRadius;
    private float $vRadius;

    public function __construct(Point $center, float $hRadius, float $vRadius, string $color = Color::BLACK)
    {
        $this->center = $center;
        $this->hRadius = $hRadius;
        $this->vRadius = $vRadius;
        $this->setColor($color);
    }

    public function getCenter() : Point
    {
        return $this->center;
    }

    public function getHorizontalRadius() : float
    {
        return $this->hRadius;
    }

    public function getVerticalRadius() : float
    {
        return $this->vRadius;
    }

    public function draw(CanvasInterface $canvas) : void
    {
        $center = $this->getCenter();
        $width = $this->getHorizontalRadius() * 2;
        $height = $this->getVerticalRadius() * 2;
        $color = $this->getColor();
        $canvas->setColor($color);
        $canvas->drawEllipse($center, $width, $height);
    }
}