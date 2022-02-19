<?php

namespace App\Slide;

use App\Canvas\CanvasInterface;
use App\Shape\ShapesInterface;

class Slide implements SlideInterface
{
    private float $width = 0;
    private float $height = 0;
    private ShapesInterface $shapes;

    public function __construct(float $width, float $height, ShapesInterface $shapes)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getShapes(): ShapesInterface
    {
        return $this->shapes;
    }

    public function draw(CanvasInterface $canvas): void
    {
        // @TODO
    }
}