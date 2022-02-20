<?php

namespace App\Shape\Group\Strategy;

use App\Shape\Rect;

interface GroupSetFrameStrategyInterface
{
    public function setFrame(Rect $frame): void;
}