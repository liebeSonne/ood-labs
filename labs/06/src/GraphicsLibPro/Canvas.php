<?php

namespace App\GraphicsLibPro;

class Canvas implements CanvasInterface
{
    public function setColor(int $rgbColor): void
    {
        // TODO: вывести в output цвет в виде строки SetColor (#RRGGBB)
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