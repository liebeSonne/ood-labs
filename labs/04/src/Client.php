<?php

namespace App;

use App\Canvas\CanvasInterface;
use App\Designer\DesignerInterface;
use App\Painter\Painter;

class Client
{
    private DesignerInterface $designer;
    private Painter $painter;
    private CanvasInterface $canvas;

    public function __construct(DesignerInterface $designer, Painter $painter, CanvasInterface $canvas)
    {
        $this->designer = $designer;
        $this->painter = $painter;
        $this->canvas = $canvas;
    }

    public function main($stream) : void
    {
        $draft = $this->designer->createDraft($stream);
        $this->painter->drawPicture($draft, $this->canvas);
    }
}