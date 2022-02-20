<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\ShapeInterface;
use App\Style\StyleStrokeInterface;

class GroupGetOutlineStyleStrategy implements GroupGetOutlineStyleStrategyInterface
{
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(ShapesEnumeratorInterface $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function getOutlineStyle(): ?StyleStrokeInterface
    {
        // возвращает null или стиль, если он одинаковый у всех элементов группы
        $curStyle = null;
        $isFirst = true;
        $done = false;
        $this->enumerator->enumShapes(function (ShapeInterface $shape) use (&$curStyle, &$isFirst, &$done) {
            if ($done) {
                return;
            }
            $style = $shape->getOutlineStyle();
            // если есть хотябы один null, то результат null
            if ($style === null) {
                $curStyle = null;
                $done = true;
                return;
            }
            // если первый - берём его значение
            if ($isFirst) {
                $curStyle = clone $style;
                $isFirst = false;
                return;
            }
            if ($style->getSize() != $curStyle->getSize()
                || $style->getColor()->getColor() !== $curStyle->getColor()->getColor()
                || $style->isEnabled() !== $curStyle->isEnabled()
            ) {
                $curStyle = null;
                $done = true;
                return;
            }
        });

        return $curStyle;
    }
}