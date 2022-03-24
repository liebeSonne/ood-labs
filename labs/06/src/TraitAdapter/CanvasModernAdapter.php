<?php

namespace App\TraitAdapter;

use App\GraphicsLib\CanvasInterface;
use App\ShapeDrawingLib\Point;

class CanvasModernAdapter implements CanvasInterface
{
    use CanvasTrait;
    use ModernGraphicsRendererTrait;

    private Point $current;
    private \SplFileObject $stream;

    public function __construct(\SplFileObject $stream)
    {
        $this->stream = $stream;
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