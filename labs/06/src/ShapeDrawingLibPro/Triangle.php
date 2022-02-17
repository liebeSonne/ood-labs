<?php

namespace App\ShapeDrawingLibPro;

use App\GraphicsLibPro\CanvasInterface;

class Triangle implements CanvasDrawableInterface
{
    private Point $p1;
    private Point $p2;
    private Point $p3;
    private int $color;

    public function __construct(Point $p1, Point $p2, Point $p3, int $color = 0x000000)
    {
        $this->p1 = $p1;
        $this->p2 = $p2;
        $this->p3 = $p3;
        $this->color = $color;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->color);
        $canvas->moveTo($this->p1->x, $this->p1->y);
        $canvas->lineTo($this->p2->x, $this->p2->y);
        $canvas->lineTo($this->p3->x, $this->p2->y);
        $canvas->lineTo($this->p1->x, $this->p1->y);
    }
}