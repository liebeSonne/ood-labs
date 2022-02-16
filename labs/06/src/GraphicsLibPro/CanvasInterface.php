<?php

namespace App\GraphicsLibPro;

interface CanvasInterface
{
    // Установка цвета в формате 0xRRGGBB
    public function setColor(int $rgbColor): void;
    public function moveTo(int $x, int $y): void;
    public function lineTo(int $x, int $y): void;
}