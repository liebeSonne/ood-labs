<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;

class Ellipse extends Shape
{
    final public function draw(CanvasInterface $canvas): void
    {
       $frame = $this->getFrame();

       $fillStyle = $this->getFillStyle();
       if ($fillStyle && $fillStyle->isEnabled() && $fillStyle->isEnabled() != null) {
           if ($fillStyle->getColor() !== null) {
               $canvas->setFillColor($fillStyle->getColor());
           }
           $canvas->fillEllipse($frame->left, $frame->top, $frame->width, $frame->height);
       }

       $lineStyle = $this->getOutlineStyle();
       if ($lineStyle && $lineStyle->isEnabled() && $lineStyle->isEnabled() !== null) {
           if ($lineStyle->getColor() !== null) {
               $canvas->setLineColor($lineStyle->getColor());
           }
           if ($lineStyle->getSize() !== null) {
               $canvas->setLineSize($lineStyle->getSize());
           }
           $canvas->drawEllipse($frame->left, $frame->top, $frame->width, $frame->height);
       }
    }
}