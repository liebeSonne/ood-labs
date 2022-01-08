<?php

namespace App;

class Point
{
    private float $x = 0;
    private float $y = 0;

    public function __construct(float $x, float $y)
    {
        $this->setX($x);
        $this->setY($y);
    }

    public function getX() : float
    {
        return $this->x;
    }

    public function getY() : float
    {
        return $this->y;
    }

    public function setX(float $x) : void
    {
        $this->x = $x;
    }

    public function setY(float $y) : void
    {
        $this->y = $y;
    }
}