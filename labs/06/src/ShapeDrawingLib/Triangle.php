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
        $this->p1 = clone $p1;
        $this->p2 = clone $p2;
        $this->p3 = clone $p3;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->moveTo($this->p1->x, $this->p1->y);
        $canvas->lineTo($this->p2->x, $this->p2->y);
        $canvas->lineTo($this->p3->x, $this->p2->y);
        $canvas->lineTo($this->p1->x, $this->p1->y);
    }
}