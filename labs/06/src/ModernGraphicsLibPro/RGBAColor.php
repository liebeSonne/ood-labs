<?php

namespace App\ModernGraphicsLibPro;

class RGBAColor
{
    private float $r;
    private float $g;
    private float $b;
    private float $a;
    
    public function __construct(float $r, float $g, float $b, float $a)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }
}