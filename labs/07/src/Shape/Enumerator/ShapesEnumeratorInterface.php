<?php

namespace App\Shape\Enumerator;

interface ShapesEnumeratorInterface
{
    public function enumShapes(callable $callback): void;
}