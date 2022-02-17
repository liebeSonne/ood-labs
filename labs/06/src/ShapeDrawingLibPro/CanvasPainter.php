<?php

namespace App\ShapeDrawingLibPro;

use App\GraphicsLibPro\CanvasInterface;

class CanvasPainter
{
    private CanvasInterface $canvas;

    public function __construct(CanvasInterface $canvas)
    {
        $this->canvas = $canvas;
    }

    public function draw(CanvasDrawableInterface $drawable): void
    {
        $drawable->draw($this->canvas);
    }
}