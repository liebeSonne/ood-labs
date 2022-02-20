<?php

namespace App\Style\Enumerator;

use App\Shape\ShapesInterface;

class FillStyleEnumerator implements StyleEnumeratorInterface
{
    private ShapesInterface $shapes;

    public function __construct(ShapesInterface $shapes)
    {
        $this->shapes = $shapes;
    }

    public function enumStyles(callable $callback): void
    {
        $count = $this->shapes->getShapesCount();
        for ($i = 0; $i < $count; $i++) {
            $shape = $this->shapes->getShapeAtIndex($i);
            if ($shape) {
                $callback($shape->getFillStyle());
            }
        }
    }
}