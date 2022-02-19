<?php

namespace App\Shape;

use App\Style\StyleInterface;

class GroupShape implements GroupShapeInterface
{
    public function getFrame(): Rect
    {
        // @TODO
    }

    public function setFrame(Rect $frame): void
    {
        // @TODO
    }

    public function getOutlineStyle(): StyleInterface
    {
        // @TODO
    }

    public function setOutlineStyle(StyleInterface $style): void
    {
        // @TODO
    }

    public function getFillStyle(): StyleInterface
    {
        // @TODO
    }

    public function setFillStyle(StyleInterface $style): void
    {
        // @TODO
    }

    public function getGroup(): ?GroupShapeInterface
    {
        // @TODO
    }


    public function getShapesCount(): int
    {
        // @TODO
    }
    public function insertShape(ShapeInterface $shape, int $position): void
    {
        // @TODO
    }
    public function getShapeAtIndex(int $index): ShapeInterface
    {
        // @TODO
    }

    public function removeShapeAtIndex(int $index): void
    {
        // @TODO
    }
}