<?php

namespace App\Canvas;

use App\Common\Point;

interface CanvasInterface
{
    public function setColor(string $color) : void;
    public function drawLine(Point $from, Point $to) : void;
    public function drawEllipse(Point $center, float $width, float $height) : void;
}