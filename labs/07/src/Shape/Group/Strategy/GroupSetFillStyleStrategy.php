<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\ShapeInterface;
use App\Style\StyleFillInterface;

class GroupSetFillStyleStrategy implements GroupSetFillStyleStrategyInterface
{
    private ?StyleFillInterface $fillStyle;
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(?StyleFillInterface &$fillStyle, ShapesEnumeratorInterface $enumerator)
    {
        $this->fillStyle =& $fillStyle;
        $this->enumerator = $enumerator;
    }

    public function setFillStyle(?StyleFillInterface $style): void
    {
        // распространение стилей на все элементы
        $this->enumerator->enumShapes(function (ShapeInterface $shape) use ($style) {
            $shape->setFillStyle($style);
        });
        $this->fillStyle = $style;
    }
}