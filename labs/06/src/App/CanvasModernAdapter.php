<?php

namespace App\App;

use App\GraphicsLib\CanvasInterface;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
use App\ModernGraphicsLib\Point;

class CanvasModernAdapter implements CanvasInterface
{
    private ModernGraphicsRenderer $renderer;
    private Point $current;

    public function __construct(ModernGraphicsRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->current = new Point(0,0);
    }

    public function moveTo(int $x, int $y): void
    {
        $this->current = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $end = new Point($x, $y);
        $this->renderer->drawLine($this->current, $end);
        $this->current = $end;
    }
}
