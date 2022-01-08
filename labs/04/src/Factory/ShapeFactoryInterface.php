<?php

namespace App\Factory;

use App\Shape\Shape;

interface ShapeFactoryInterface
{
    public function createShape(string $description) : ?Shape;
}