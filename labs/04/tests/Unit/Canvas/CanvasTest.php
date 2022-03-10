<?php

namespace Tests\Unit\Canvas;

use App\Canvas\Canvas;
use App\Common\Color;
use App\Common\Point;
use PHPUnit\Framework\TestCase;

class CanvasTest extends TestCase
{
    public function testSetColor(): void
    {
        $color = Color::BLUE;
        $canvas = new Canvas();

        $text = "\n[canvas]: set color " . $color;
        $this->expectOutputString($text);

        $canvas->setColor($color);
    }

    public function testDrawLine(): void
    {
        $from = new Point(1,1);
        $to = new Point(2,2);
        $canvas = new Canvas();

        $text = "\n[canvas]: draw line "
            . ' from ('. $from->getX() . ', ' . $from->getY() . ') '
            . ' to ('. $to->getX() . ', ' . $to->getY() . ')';
        $this->expectOutputString($text);

        $canvas->drawLine($from, $to);
    }

    public function testDrawEllipse(): void
    {
        $center = new Point(1,1);
        $width = 10.1;
        $height = 22.2;
        $canvas = new Canvas();

        $text = "\n[canvas]: draw ellipse "
            . ' center=(' . $center->getX() . ', ' . $center->getY() . ')'
            . ', width=' . $width
            . ', height=' . $height ;
        $this->expectOutputString($text);

        $canvas->drawEllipse($center, $width, $height);
    }
}