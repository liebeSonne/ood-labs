<?php

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

class Rectangle implements CanvasDrawableInterface
{
    private Point $leftTop;
    private int $width;
    private int $height;

    public function __construct(Point $leftTop, int $width, int $height)
    {
        $this->leftTop = $leftTop;
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(CanvasInterface $canvas): void
    {
        // TODO: написать код рисования прямоугольника на холсте
    }

    // TODO: дописать приватную часть
}