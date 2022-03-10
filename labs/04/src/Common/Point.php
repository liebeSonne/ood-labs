<?php

namespace App\Common;

class Point
{
    private float $x = 0;
    private float $y = 0;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX() : float
    {
        return $this->x;
    }

    public function getY() : float
    {
        return $this->y;
    }
}