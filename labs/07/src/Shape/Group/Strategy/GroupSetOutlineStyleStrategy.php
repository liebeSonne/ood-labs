<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\ShapeInterface;
use App\Style\StyleStrokeInterface;

class GroupSetOutlineStyleStrategy implements GroupSetOutlineStyleStrategyInterface
{
    private ?StyleStrokeInterface $outlineStyle;
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(?StyleStrokeInterface &$outlineStyle, ShapesEnumeratorInterface $enumerator)
    {
        $this->outlineStyle =& $outlineStyle;
        $this->enumerator = $enumerator;
    }

    public function setOutlineStyle(?StyleStrokeInterface $style): void
    {
        $this->enumerator->enumShapes(function (ShapeInterface $shape) use ($style) {
            $shape->setOutlineStyle($style);
        });
        $this->outlineStyle = $style;
    }
}