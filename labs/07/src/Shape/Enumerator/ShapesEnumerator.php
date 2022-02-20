<?php

namespace App\Shape\Enumerator;

use App\Shape\ShapesInterface;

class ShapesEnumerator implements ShapesEnumeratorInterface
{
    private ShapesInterface $shapes;

    public function __construct(ShapesInterface $shapes)
    {
        $this->shapes = $shapes;
    }

    public function enumShapes(callable $callback): void
    {
        $count = $this->shapes->getShapesCount();
        for ($i = 0; $i < $count; $i++) {
            $shape = $this->shapes->getShapeAtIndex($i);
            if ($shape !== null) {
                $callback($shape);
            }
        }
    }
}