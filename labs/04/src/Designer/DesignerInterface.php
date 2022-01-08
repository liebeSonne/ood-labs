<?php

namespace App\Designer;

use App\Draft\PictureDraft;

interface DesignerInterface
{
    public function createDraft($stream) : PictureDraft;
}