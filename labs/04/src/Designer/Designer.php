<?php

namespace App\Designer;

use App\Draft\PictureDraft;
use App\Factory\ShapeFactoryInterface;

class Designer implements DesignerInterface
{
    protected ShapeFactoryInterface $factory;

    public function __construct(ShapeFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createDraft($stream) : PictureDraft
    {
        $draft = new PictureDraft();
        while ($description = stream_get_line($stream, 65535, "\n")) {
            $shape = $this->factory->createShape($description);
            if ($shape !== null) {
                $draft->add($shape);
            }
        }
        return $draft;
    }
}