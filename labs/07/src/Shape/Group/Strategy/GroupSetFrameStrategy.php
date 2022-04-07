<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;

class GroupSetFrameStrategy implements GroupSetFrameStrategyInterface
{
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(ShapesEnumeratorInterface $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function setFrame(Rect $frame, Rect $groupFrame): void
    {
        $diffLeft = $frame->left - $groupFrame->left;
        $diffTop = $frame->top - $groupFrame->top;
        $scaleWidth = $groupFrame->width != 0 ? $frame->width / $groupFrame->width : 0;
        $scaleHeight = $groupFrame->height != 0 ? $frame->height / $groupFrame->height : 0;

        $this->enumerator->enumShapes(function (ShapeInterface $shape) use (&$diffLeft, &$diffTop, &$scaleWidth, &$scaleHeight) {
            // пропорциональное изменение размера и положения всем элементам
            $shapeFrame = $shape->getFrame();
            $shapeFrame->left += $diffLeft;
            $shapeFrame->top += $diffTop;
            $shapeFrame->width *= $scaleWidth;
            $shapeFrame->height *= $scaleHeight;
            $shape->setFrame($shapeFrame);
        });
    }
}