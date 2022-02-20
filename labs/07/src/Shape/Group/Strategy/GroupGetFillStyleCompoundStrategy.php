<?php

namespace App\Shape\Group\Strategy;

use App\Style\Compound\CompoundFillStyle;
use App\Style\Enumerator\FillStyleEnumerator;
use App\Style\StyleFillInterface;

class GroupGetFillStyleCompoundStrategy implements GroupGetFillStyleStrategyInterface
{
    private ?StyleFillInterface $style;
    private FillStyleEnumerator $enumerator;

    public function __construct(FillStyleEnumerator $enumerator)
    {
        $this->enumerator = $enumerator;
        $this->style = new CompoundFillStyle($this->enumerator);
    }

    public function getFillStyle(): ?StyleFillInterface
    {
        return $this->style;
    }
}