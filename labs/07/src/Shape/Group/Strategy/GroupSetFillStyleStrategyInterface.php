<?php

namespace App\Shape\Group\Strategy;

use App\Style\StyleFillInterface;

interface GroupSetFillStyleStrategyInterface
{
    public function setFillStyle(?StyleFillInterface $style): void;
}