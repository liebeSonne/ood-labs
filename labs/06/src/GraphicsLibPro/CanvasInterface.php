<?php

namespace App\GraphicsLibPro;

interface CanvasInterface
{
    public function setColor(int $rgbColor): void;
    public function moveTo(int $x, int $y): void;
    public function lineTo(int $x, int $y): void;
}