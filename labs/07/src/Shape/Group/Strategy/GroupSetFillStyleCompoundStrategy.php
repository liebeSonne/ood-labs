<?php

namespace App\Shape\Group\Strategy;

use App\Style\Compound\CompoundFillStyle;
use App\Style\Enumerator\FillStyleEnumerator;
use App\Style\StyleFillInterface;

class GroupSetFillStyleCompoundStrategy implements GroupSetFillStyleStrategyInterface
{
    private ?StyleFillInterface $style;
    private FillStyleEnumerator $enumerator;

    public function __construct(?StyleFillInterface &$style, FillStyleEnumerator $enumerator)
    {
        $this->style =& $style;
        $this->enumerator = $enumerator;
        $this->style = new CompoundFillStyle($this->enumerator);
    }

    public function setFillStyle(?StyleFillInterface $style): void
    {
        if ($style !== null) {
            $this->style->setColor($style->getColor());
            $this->style->enable($style->isEnabled());
        }
    }
}