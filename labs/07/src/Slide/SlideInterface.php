<?php

namespace App\Slide;

use App\Canvas\DrawableInterface;
use App\Shape\ShapesInterface;

interface SlideInterface extends DrawableInterface
{
    public function getWidth(): float;
    public function getHeight(): float;
    public function getShapes(): ShapesInterface;
}