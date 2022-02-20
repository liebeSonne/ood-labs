<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Rect;

interface GroupGetFrameStrategyInterface
{
    public function getFrame(): ?Rect;
}