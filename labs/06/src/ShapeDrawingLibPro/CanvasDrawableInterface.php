<?php

namespace App\ShapeDrawingLibPro;

use App\GraphicsLibPro\CanvasInterface;

interface CanvasDrawableInterface
{
    public function draw(CanvasInterface $canvas): void;
}