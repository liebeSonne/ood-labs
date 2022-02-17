<?php

namespace App\GraphicsLibPro;

class Canvas implements CanvasInterface
{
    public function setColor(int $rgbColor): void
    {
        echo "SetColor (#" . substr("000000".dechex($rgbColor),-6) . ")\n";
    }

    public function moveTo(int $x, int $y): void
    {
        echo "MoveTo ($x, $y)\n";
    }

    public function lineTo(int $x, int $y): void
    {
        echo "LineTo ($x, $y)\n";
    }
}