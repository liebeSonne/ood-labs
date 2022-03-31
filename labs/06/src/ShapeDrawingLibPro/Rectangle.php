<?php

namespace App\ShapeDrawingLibPro;

use App\GraphicsLibPro\CanvasInterface;

class Rectangle implements CanvasDrawableInterface
{
    private Point $leftTop;
    private int $width;
    private int $height;
    private int $color;

    public function __construct(Point $leftTop, int $width, int $height, int $color = 0x000000)
    {
        $this->leftTop = clone $leftTop;
        $this->width = $width;
        $this->height = $height;
        $this->color = $color;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $xRight = $this->leftTop->x + $this->width;
        $yBottom = $this->leftTop->y + $this->height;

        $canvas->setColor($this->color);
        $canvas->moveTo($this->leftTop->x, $this->leftTop->y);
        $canvas->lineTo($xRight, $this->leftTop->y);
        $canvas->lineTo($xRight, $yBottom);
        $canvas->lineTo($this->leftTop->x, $yBottom);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y);
    }
}