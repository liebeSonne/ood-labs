<?php

namespace App\Shape\Group\Strategy;

use App\Style\StyleStrokeInterface;

interface GroupGetOutlineStyleStrategyInterface
{
    public function getOutlineStyle(): ?StyleStrokeInterface;
}