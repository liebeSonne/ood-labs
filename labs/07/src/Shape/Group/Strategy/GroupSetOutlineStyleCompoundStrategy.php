<?php

namespace App\Shape\Group\Strategy;

use App\Style\Compound\CompoundStrokeStyle;
use App\Style\Enumerator\StrokeStyleEnumerator;
use App\Style\StyleStrokeInterface;

class GroupSetOutlineStyleCompoundStrategy implements GroupSetOutlineStyleStrategyInterface
{
    private ?StyleStrokeInterface $outlineStyle;
    private StrokeStyleEnumerator $enumerator;

    public function __construct(?StyleStrokeInterface &$outlineStyle, StrokeStyleEnumerator $enumerator)
    {
        $this->outlineStyle =& $outlineStyle;
        $this->enumerator = $enumerator;
        $this->outlineStyle = new CompoundStrokeStyle($this->enumerator);
    }

    public function setOutlineStyle(?StyleStrokeInterface $style): void
    {
        if ($style !== null) {
            $this->outlineStyle->setColor($style->getColor());
            $this->outlineStyle->setSize($style->getSize());
            $this->outlineStyle->enable($style->isEnabled());
        }
    }
}