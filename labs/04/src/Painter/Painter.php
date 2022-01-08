<?php

namespace App\Painter;

use App\Canvas\CanvasInterface;
use App\Draft\PictureDraft;

class Painter
{
    public function drawPicture(PictureDraft $draft, CanvasInterface $canvas) : void
    {
        $count = $draft->getShapeCount();
        for ($index = 0; $index < $count; $index++)
        {
            $shape = $draft->getShape($index);
            $shape->draw($canvas);
        }
    }
}