<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Shape\Strategy\DrawingStrategy;

class SimpleShape extends Shape implements ShapeInterface
{
    private DrawingStrategy $drawingStrategy;

    public function __construct(DrawingStrategy $drawingStrategy)
    {
        $this->drawingStrategy = $drawingStrategy;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $this->drawingStrategy->draw();
    }
}