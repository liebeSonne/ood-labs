<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Common\Point;

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
        if ($fillStyle && $fillStyle->isEnabled() && $fillStyle->isEnabled() !== null) {
            if ($fillStyle->getColor() !== null) {
                $canvas->setFillColor($fillStyle->getColor());
            }
            $canvas->fillRect($points);
        }

        $lineStyle = $this->getOutlineStyle();
        if ($lineStyle && $lineStyle->isEnabled() && $lineStyle->isEnabled() !== null) {
            if ($lineStyle->getColor() !== null) {
                $canvas->setLineColor($lineStyle->getColor());
            }
            if ($lineStyle->getSize() !== null) {
                $canvas->setLineSize($lineStyle->getSize());
            }
            $canvas->drawRect($points);
        }
    }
}