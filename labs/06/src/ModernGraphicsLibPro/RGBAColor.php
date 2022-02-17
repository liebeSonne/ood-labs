<?php

namespace App\ModernGraphicsLibPro;

class RGBAColor
{
    public float $r;
    public float $g;
    public float $b;
    public float $a;
    
    public function __construct(float $r, float $g, float $b, float $a)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }
}