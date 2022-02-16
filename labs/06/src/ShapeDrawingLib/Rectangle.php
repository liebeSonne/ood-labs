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
        $xRight = $this->leftTop->x + $this->width;
        $yBottom = $this->leftTop->y + $this->height;

        $canvas->moveTo($this->leftTop->x, $this->leftTop->y);
        $canvas->lineTo($xRight, $this->leftTop->y);
        $canvas->lineTo($xRight, $yBottom);
        $canvas->lineTo($this->leftTop->x, $yBottom);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y);
    }
}