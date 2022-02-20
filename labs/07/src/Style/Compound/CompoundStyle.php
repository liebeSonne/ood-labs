<?php

namespace App\Style\Compound;

use App\Style\Enumerator\StyleEnumeratorInterface;
use App\Style\RGBAColor;
use App\Style\StyleInterface;

class CompoundStyle implements StyleInterface
{
    private ?StyleInterface $style;
    private StyleEnumeratorInterface $enumerator;

    public function __construct(?StyleInterface $style, StyleEnumeratorInterface $enumerator)
    {
        $this->style = $style;
        $this->enumerator = $enumerator;
    }

    public function isEnabled(): bool
    {
        $isEnables = true;
        $hasItems = false;
        $this->enumerator->enumStyles(function (?StyleInterface $style) use (&$isEnables, &$hasItems) {
            $isEnables = $isEnables && $style !== null && $style->isEnabled();
            $hasItems = true;
        });

        if (!$hasItems && $this->style !== null) {
            $isEnables = $this->style->isEnabled();
        }

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

        if ($color === null) {
            $color = $this->style !== null ? $this->style->getColor()->getColor() : 0;
        }

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