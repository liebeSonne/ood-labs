<?php

namespace App\Shape;

class Rect
{
    public float $left;
    public float $top;
    public float $width;
    public float $height;

    public function __construct(float $left, float $top, float $width, float $height)
    {
        $this->left = $left;
        $this->top = $top;
        $this->width = $width;
        $this->height = $height;
    }
}