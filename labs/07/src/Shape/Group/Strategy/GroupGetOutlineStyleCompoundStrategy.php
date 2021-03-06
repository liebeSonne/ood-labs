<?php

namespace App\Shape\Group\Strategy;

use App\Style\Compound\CompoundStrokeStyle;
use App\Style\Enumerator\StrokeStyleEnumerator;
use App\Style\StyleStrokeInterface;

class GroupGetOutlineStyleCompoundStrategy implements GroupGetOutlineStyleStrategyInterface
{
    private ?StyleStrokeInterface $style;
    private StrokeStyleEnumerator $enumerator;

    public function __construct(?StyleStrokeInterface $style, StrokeStyleEnumerator $enumerator)
    {
        $this->enumerator = $enumerator;
        $this->style = new CompoundStrokeStyle($style, $this->enumerator);
    }

    public function getOutlineStyle(): ?StyleStrokeInterface
    {
        return $this->style;
    }
}