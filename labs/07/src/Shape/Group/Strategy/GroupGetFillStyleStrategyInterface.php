<?php

namespace App\Shape\Group\Strategy;

use App\Style\StyleFillInterface;

interface GroupGetFillStyleStrategyInterface
{
    public function getFillStyle(): ?StyleFillInterface;
}