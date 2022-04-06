<?php

namespace App\Shape;

use App\Canvas\DrawableInterface;
use App\Shape\Group\GroupShapeInterface;
use App\Style\StyleFillInterface;
use App\Style\StyleStrokeInterface;

interface ShapeInterface extends DrawableInterface
{
    public function getFrame(): Rect;
    public function setFrame(Rect $frame): void;

    public function getOutlineStyle(): StyleStrokeInterface;

    public function getFillStyle(): StyleFillInterface;

    public function getGroup(): ?GroupShapeInterface;
}