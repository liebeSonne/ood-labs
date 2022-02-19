<?php

namespace App\Style;

class StyleStroke extends Style implements StyleStrokeInterface
{
    private float $size;

    public function __construct(RGBAColor $color, float $size = 1)
    {
        parent::__construct($color);
        $this->size = $size;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function setSize(float $size): void
    {
        $this->size = $size;
    }
}