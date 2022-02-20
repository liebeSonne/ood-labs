<?php

namespace App\Style\Compound;

use App\Style\Enumerator\StyleEnumeratorInterface;
use App\Style\RGBAColor;
use App\Style\StyleInterface;

class CompoundStyle implements StyleInterface
{
    private StyleEnumeratorInterface $enumerator;

    public function __construct(StyleEnumeratorInterface $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function isEnabled(): bool
    {
        $isEnables = true;
        $this->enumerator->enumStyles(function (?StyleInterface $style) use (&$isEnables) {
            $isEnables = $isEnables && $style !== null && $style->isEnabled();
        });
        return $isEnables;
    }

    public function enable(bool $enable): void
    {
        $this->enumerator->enumStyles(function (?StyleInterface &$style) use ($enable) {
            if ($style !== null) {
                $style->enable($enable);
            }
        });
    }

    public function getColor(): RGBAColor
    {
        $color = null;
        $isFirst = true;
        $hasNull = false;
        $this->enumerator->enumStyles(function (?StyleInterface $style) use (&$color, &$isFirst, &$hasNull) {
            if ($style === null) {
                $hasNull = true;
            } elseif (!$hasNull) {
                if ($isFirst) {
                    $color = $style->getColor()->getColor();
                    $isFirst = false;
                } elseif ($color === null || $color !== $style->getColor()->getColor()) {
                    $color = null;
                }
            }
        });

        return new RGBAColor($color);
    }

    public function setColor(RGBAColor $color): void
    {
        $this->enumerator->enumStyles(function (?StyleInterface &$style) use ($color) {
            if ($style !== null) {
                $style->setColor($color);
            }
        });
    }
}