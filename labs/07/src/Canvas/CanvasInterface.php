<?php

namespace App\Canvas;

use App\Style\RGBAColor;

interface CanvasInterface
{
    public function setLineColor(RGBAColor $color): void;
    public function beginFill(RGBAColor $color): void;
    public function endFill(): void;
    public function moveTo(float $x, float $y): void;
    public function lineTo(float $x, float $y): void;
    public function drawEllipse(float $left, float $top, float $width, float $height): void;
}