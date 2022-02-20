<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\ShapeInterface;
use App\Style\StyleFillInterface;

class GroupGetFillStyleStrategy implements GroupGetFillStyleStrategyInterface
{
    private ?StyleFillInterface $fillStyle;
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(?StyleFillInterface &$fillStyle, ShapesEnumeratorInterface $enumerator)
    {
        $this->fillStyle =& $fillStyle;
        $this->enumerator = $enumerator;
    }

    public function getFillStyle(): ?StyleFillInterface
    {
        // возвращает null или стиль, если он одинаковый у всех элементов группы
        $curStyle = null;
        $isFirst = true;
        $done = false;
        $this->enumerator->enumShapes(function (ShapeInterface $shape) use (&$curStyle, &$isFirst, &$done) {
            if ($done) {
                return;
            }
            $style = $shape->getFillStyle();
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
            if ($style->getColor()->getColor() !== $curStyle->getColor()->getColor()
                || $style->isEnabled() !== $curStyle->isEnabled()
            ) {
                $curStyle = null;
                $done = true;
                return;
            }
        });

        $this->fillStyle = $curStyle;

        return $this->fillStyle;
    }
}