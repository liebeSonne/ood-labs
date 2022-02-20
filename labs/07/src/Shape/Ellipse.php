<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;

class Ellipse extends Shape
{
   public function draw(CanvasInterface $canvas): void
   {
       $frame = $this->getFrame();

       $fillStyle = $this->getFillStyle();
       if ($fillStyle && $fillStyle->isEnabled()) {
           $canvas->setFillColor($fillStyle->getColor());
           $canvas->fillEllipse($frame->left, $frame->top, $frame->width, $frame->height);
       }

       $lineStyle = $this->getOutlineStyle();
       if ($lineStyle && $lineStyle->isEnabled()) {
           $canvas->setLineColor($lineStyle->getColor());
           $canvas->setLineSize($lineStyle->getSize());
           $canvas->drawEllipse($frame->left, $frame->top, $frame->width, $frame->height);
       }
   }
}