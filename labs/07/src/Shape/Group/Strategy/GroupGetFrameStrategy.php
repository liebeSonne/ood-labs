<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;

class GroupGetFrameStrategy implements GroupGetFrameStrategyInterface
{
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(ShapesEnumeratorInterface $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function getFrame(): Rect
    {
        // фрейм расчитывается так, чтобы охватить фреймы всех входящих в группу элементов
        $groupFrame = new Rect(0,0,0,0);
        $minX = null;
        $minY = null;
        $maxX = null;
        $maxY = null;
        $this->enumerator->enumShapes(function (ShapeInterface $shape) use(&$minX, &$minY, &$maxX, &$maxY, &$groupFrame) {
            $frame = $shape->getFrame();
            // не учитываем элементы с нулевыми размерами
            if ($frame->width == 0 || $frame->height == 0) {
                return;
            }
            $x0 = $frame->left;
            $y0 = $frame->top;
            $xm = $frame->left + $frame->width;
            $ym = $frame->top + $frame->height;
            if ($minX === null || $minX > $x0) {
                $minX = $x0;
            }
            if ($minY === null || $minY > $y0) {
                $minY = $y0;
            }
            if ($maxX === null || $maxX < $xm) {
                $maxX = $xm;
            }
            if ($maxY === null || $maxY < $ym) {
                $maxY = $ym;
            }
            $groupFrame->left = $minX;
            $groupFrame->top = $minY;
            $groupFrame->width = $maxX - $minX;
            $groupFrame->height = $maxY - $minY;
        });

        return $groupFrame;
    }
}