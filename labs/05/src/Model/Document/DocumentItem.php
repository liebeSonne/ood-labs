<?php

namespace App\Model\Document;

class DocumentItem extends ConstDocumentItem
{
    public function getImage(): ?ImageInterface
    {
        return null;
    }

    public function getParagraph(): ?ParagraphInterface
    {
        return null;
    }
}