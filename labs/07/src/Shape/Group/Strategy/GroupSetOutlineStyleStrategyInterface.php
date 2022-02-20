<?php

namespace App\Shape\Group\Strategy;

use App\Style\StyleStrokeInterface;

interface GroupSetOutlineStyleStrategyInterface
{
    public function setOutlineStyle(?StyleStrokeInterface $style): void;
}