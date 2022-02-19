<?php

namespace App\Shape;

use App\Canvas\DrawableInterface;
use App\Shape\Group\GroupShapeInterface;
use App\Style\StyleInterface;

interface ShapeInterface extends DrawableInterface
{
    public function getFrame(): Rect;
    public function setFrame(Rect $frame): void;

    public function getOutlineStyle(): StyleInterface;
    public function setOutlineStyle(StyleInterface $style): void;

    public function getFillStyle(): StyleInterface;
    public function setFillStyle(StyleInterface $style): void;

    public function getGroup(): ?GroupShapeInterface;
}