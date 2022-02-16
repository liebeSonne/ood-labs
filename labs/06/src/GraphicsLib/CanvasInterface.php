<?php

namespace App\GraphicsLib;

interface CanvasInterface
{
    // Ставит "перо" в точку x, y
    public function moveTo(int $x, int $y): void;

    // Рисует линию с текущей позиции, передвигая перо в точку x,y
    public function lineTo(int $x, int $y): void;
}