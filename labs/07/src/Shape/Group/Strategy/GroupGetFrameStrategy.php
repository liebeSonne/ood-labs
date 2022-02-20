<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;

class GroupGetFrameStrategy implements GroupGetFrameStrategyInterface
{
    private Rect $frame;
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(Rect &$frame, ShapesEnumeratorInterface $enumerator)
    {
        $this->frame =& $frame;
        $this->enumerator = $enumerator;
    }

    public function getFrame(): ?Rect
    {
        // фрейм расчитывается так, чтобы охватить фреймы всех входящих в группу элементов
        $this->frame->left = 0;
        $this->frame->top = 0;
        $this->frame->width = 0;
        $this->frame->height = 0;
        $minX = null;
        $minY = null;
        $maxX = null;
        $maxY = null;
        $this->enumerator->enumShapes(function (ShapeInterface $shape) use(&$minX, &$minY, &$maxX, &$maxY) {
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
            $this->frame->left = $minX;
            $this->frame->top = $minY;
            $this->frame->width = $maxX - $minX;
            $this->frame->height = $maxY - $minY;
        });

        return $this->frame;
    }
}