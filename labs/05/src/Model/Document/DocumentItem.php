<?php

namespace App\Model\Document;

use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;

class DocumentItem extends ConstDocumentItem
{
    public function setImage(?ImageInterface $image): void
    {
        $this->image = $image;
    }

    public function setParagraph(?ParagraphInterface $paragraph): void
    {
        $this->paragraph = $paragraph;
    }
}