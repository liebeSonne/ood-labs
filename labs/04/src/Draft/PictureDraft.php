<?php

namespace App\Draft;

use App\Shape\Shape;

class PictureDraft
{
    /**
     * @var Shape[]
     */
    private array $shapes = [];

    public function getShapeCount() : int
    {
        return count($this->shapes);
    }

    public function getShape(int $index) : ?Shape
    {
        return $this->shapes[$index] ?? null;
    }

    public function add(Shape $shape) : void
    {
        $this->shapes[] = $shape;
    }
}