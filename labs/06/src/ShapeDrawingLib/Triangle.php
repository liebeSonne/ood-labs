<?php

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

class Triangle implements CanvasDrawableInterface
{
    private Point $p1;
    private Point $p2;
    private Point $p3;

    public function __construct(Point $p1, Point $p2, Point $p3)
    {
        $this->p1 = $p1;
        $this->p2 = $p2;
        $this->p3 = $p3;
    }

    public function draw(CanvasInterface $canvas): void
    {
        // TODO: написать код рисования треугольника на холсте
    }

    // TODO: дописать приватную часть
}