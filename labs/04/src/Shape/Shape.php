<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Color;

abstract class Shape
{
    private string $color = Color::BLACK;

    abstract public function draw(CanvasInterface $canvas) : void;

    public function getColor() : string
    {
        return $this->color;
    }

    public function setColor(string $color) : void
    {
        $this->color = $color;
    }
}