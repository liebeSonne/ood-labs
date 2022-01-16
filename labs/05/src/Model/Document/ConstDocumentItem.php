<?php

namespace App\Model\Document;

use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;

class ConstDocumentItem
{
    protected ?ImageInterface $image;

    protected ?ParagraphInterface $paragraph;

    public function __construct(?ImageInterface $image = null, ?ParagraphInterface $paragraph = null)
    {
        $this->image = $image;
        $this->paragraph = $paragraph;
    }

    public function getImage(): ?ImageInterface
    {
        return $this->image;
    }

    public function getParagraph(): ?ParagraphInterface
    {
        return $this->paragraph;
    }
}