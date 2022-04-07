<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Enumerator\ShapesEnumeratorInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;

class GroupSetFrameStrategy implements GroupSetFrameStrategyInterface
{
    private Rect $frame;
    private ShapesEnumeratorInterface $enumerator;

    public function __construct(Rect &$frame, ShapesEnumeratorInterface $enumerator)
    {
        $this->frame =& $frame;
        $this->enumerator = $enumerator;
    }

    public function setFrame(Rect $frame): void
    {
        $diffLeft = $frame->left - $this->frame->left;
        $diffTop = $frame->top - $this->frame->top;
        $scaleWidth = $this->frame->width != 0 ? $frame->width / $this->frame->width : 0;
        $scaleHeight = $this->frame->height != 0 ? $frame->height / $this->frame->height : 0;

        $this->enumerator->enumShapes(function (ShapeInterface $shape) use (&$diffLeft, &$diffTop, &$scaleWidth, &$scaleHeight) {
            // пропорциональное изменение размера и положения всем элементам
            $shapeFrame = $shape->getFrame();
            $shapeFrame->left += $diffLeft;
            $shapeFrame->top += $diffTop;
            $shapeFrame->width *= $scaleWidth;
            $shapeFrame->height *= $scaleHeight;
            $shape->setFrame($shapeFrame);
        });

        $this->frame = clone $frame;
    }
}