<?php

namespace App\Canvas;

use App\Point;

class Canvas implements CanvasInterface
{
    public function setColor(string $color) : void
    {
        echo "\n[canvas]: set color " . $color;
    }

    public function drawLine(Point $from, Point $to) : void
    {
        echo "\n[canvas]: draw line "
            . ' from ('. $from->getX() . ', ' . $from->getY() . ') '
            . ' to ('. $to->getX() . ', ' . $to->getY() . ')';
    }

    public function drawEllipse(Point $center, float $width, float $height) : void
    {
        echo "\n[canvas]: draw ellipse "
            . ' center=(' . $center->getX() . ', ' . $center->getY(). ')'
            . ', width=' . $width
            . ', height=' . $height ;
    }
}