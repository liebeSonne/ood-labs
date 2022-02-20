<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Canvas\Point;

class Triangle extends Shape
{
    final public function draw(CanvasInterface $canvas): void
    {
        $frame = $this->getFrame();

        $points = [
            new Point($frame->left, $frame->top + $frame->height),
            new Point($frame->left + $frame->width, $frame->top + $frame->height),
            new Point($frame->left + $frame->width / 2, $frame->top),
        ];

        $fillStyle = $this->getFillStyle();
        if ($fillStyle && $fillStyle->isEnabled()) {
            $canvas->setFillColor($fillStyle->getColor());
            $canvas->fillRect($points);
        }

        $lineStyle = $this->getOutlineStyle();
        if ($lineStyle && $lineStyle->isEnabled()) {
            $canvas->setLineColor($lineStyle->getColor());
            $canvas->setLineSize($lineStyle->getSize());
            $canvas->drawRect($points);
        }
    }
}