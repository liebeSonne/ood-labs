<?php

namespace App\Command\Document;

use App\Command\AbstractCommand;
use App\Model\Image\ImageInterface;

class ResizeImageCommand extends AbstractCommand
{
    private ImageInterface $image;
    private int $oldWidth;
    private int $oldHeight;
    private int $newWidth;
    private int $newHeight;

    public function __construct(ImageInterface &$image, int $width, int $height)
    {
        $this->image = $image;
        $this->newWidth = $width;
        $this->newHeight = $height;
        $this->oldWidth = $this->image->getWidth();
        $this->oldHeight = $this->image->getHeight();
    }

    protected function doExecute(): void
    {
        $this->oldWidth = $this->image->getWidth();
        $this->oldHeight = $this->image->getHeight();
        $this->image->resize($this->newWidth, $this->newHeight);
    }

    protected function doUnexecute(): void
    {
        $this->image->resize($this->oldWidth, $this->oldHeight);
    }
}