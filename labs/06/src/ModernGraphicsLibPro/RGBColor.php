<?php

namespace App\ModernGraphicsLibPro;

class RGBColor
{
    private float $r;
    private float $g;
    private float $b;
    
    public function __construct(float $r, float $g, float $b)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }
}