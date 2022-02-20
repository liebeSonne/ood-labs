<?php

namespace App\Style\Compound;

use App\Style\Enumerator\StrokeStyleEnumerator;
use App\Style\StyleFillInterface;
use App\Style\StyleStrokeInterface;

class CompoundStrokeStyle extends CompoundStyle implements StyleStrokeInterface
{
    private ?StyleStrokeInterface $style;
    private StrokeStyleEnumerator $enumerator;

    public function __construct(?StyleStrokeInterface $style, StrokeStyleEnumerator $enumerator)
    {
        $this->style = $style;
        parent::__construct($style, $enumerator);
        $this->enumerator = $enumerator;
    }

    public function getSize(): float
    {
        $size = null;
        $isFirst = true;
        $hasNull = false;
        $this->enumerator->enumStyles(function (?StyleStrokeInterface &$style) use (&$size, &$isFirst, &$hasNull) {
            if ($style === null) {
                $hasNull = true;
            } elseif (!$hasNull) {
                if ($isFirst) {
                    $size = $style->getSize();
                    $isFirst = false;
                } elseif ($size === null || $size !== $style->getSize()) {
                    $size = null;
                }
            }
        });

        if ($size === null) {
            $size = $this->style !== null ? $this->style->getSize() : 0;
        }

        return $size;
    }

    public function setSize(float $size): void
    {
        $this->enumerator->enumStyles(function (?StyleStrokeInterface &$style) use ($size) {
            if ($style !== null) {
                $style->setSize($size);
            }
        });
    }
}