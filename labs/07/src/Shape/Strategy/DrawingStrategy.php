<?php

namespace App\Shape\Strategy;

use App\Canvas\CanvasInterface;
use App\Shape\ShapeInterface;

class DrawingStrategy
{
    private CanvasInterface $canvas;
    private ShapeInterface $shape;

    public function __construct(CanvasInterface $canvas, ShapeInterface $shape)
    {
        $this->canvas = $canvas;
        $this->shape = $shape;
    }

    public function draw()
    {
        $this->shape->draw($this->canvas);
    }
}