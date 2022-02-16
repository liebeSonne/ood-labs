<?php

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

interface CanvasDrawableInterface
{
    public function draw(CanvasInterface $canvas): void;
}