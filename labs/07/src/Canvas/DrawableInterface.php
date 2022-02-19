<?php

namespace App\Canvas;

interface DrawableInterface
{
    public function draw(CanvasInterface $canvas): void;
}
