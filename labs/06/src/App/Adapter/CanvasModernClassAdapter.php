<?php

namespace App\App\Adapter;

use App\GraphicsLib\CanvasInterface;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
use App\ModernGraphicsLib\Point;

class CanvasModernClassAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    private Point $current;

    public function __construct(\SplFileObject $stream)
    {
        parent::__construct($stream);
        $this->current = new Point(0,0);
    }

    public function moveTo(int $x, int $y): void
    {
        $this->current = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $end = new Point($x, $y);
        $this->drawLine($this->current, $end);
        $this->current = $end;
    }
}