<?php

namespace App\Style\Compound;

use App\Style\Enumerator\StyleEnumeratorInterface;
use App\Style\StyleStrokeInterface;

class CompoundStrokeStyle extends CompoundStyle implements StyleStrokeInterface
{
    private StyleEnumeratorInterface $enumerator;

    public function __construct(StyleEnumeratorInterface $enumerator)
    {
        parent::__construct($enumerator);
        $this->enumerator = $enumerator;
    }

    public function getSize(): ?float
    {
        $size = null;
        $isFirst = true;
        $this->enumerator->enumStyles(function (StyleStrokeInterface &$style) use (&$size, &$isFirst, &$hasNull) {
            if ($isFirst) {
                $size = $style->getSize();
                $isFirst = false;
            } elseif ($size === null || $size !== $style->getSize()) {
                $size = null;
            }
        });

        return $size;
    }

    public function setSize(float $size): void
    {
        $this->enumerator->enumStyles(function (StyleStrokeInterface &$style) use ($size) {
            $style->setSize($size);
        });
    }
}