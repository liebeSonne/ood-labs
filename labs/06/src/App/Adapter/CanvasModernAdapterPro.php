<?php

namespace App\App\Adapter;

use App\GraphicsLibPro\CanvasInterface;
use App\ModernGraphicsLibPro\ModernGraphicsRenderer;
use App\ModernGraphicsLibPro\Point;
use App\ModernGraphicsLibPro\RGBAColor;

class CanvasModernAdapterPro implements CanvasInterface
{
    private ModernGraphicsRenderer $renderer;
    private Point $current;
    private RGBAColor $color;

    public function __construct(ModernGraphicsRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->current = new Point(0,0);
        $this->color = new RGBAColor(0,0,0,1);
    }

    public function setColor(int $rgbColor): void
    {
        $r = ($rgbColor >> 16) & 0xFF;
        $g = ($rgbColor >> 8) & 0xFF;
        $b = $rgbColor & 0xFF;
        $a = 1;
        $this->color = new RGBAColor($r, $g, $b, $a);
    }

    public function moveTo(int $x, int $y): void
    {
        $this->current = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $end = new Point($x, $y);
        $this->renderer->drawLine($this->current, $end, $this->color);
        $this->current = $end;
    }
}
