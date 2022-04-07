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

    public function isEnabled(): ?bool
    {
        $isEnabled = null;
        $isFirst = true;
        $this->enumerator->enumStyles(function (StyleInterface $style) use (&$isEnabled, &$isFirst) {
            if ($style->isEnabled() == null) {
                $isEnabled = null;
            } elseif ($isFirst) {
                $isEnabled = $style->isEnabled();
            } elseif($isEnabled == null) {
                $isEnabled = null;
            } else {
                $isEnabled = $isEnabled && $style->isEnabled();
            }
            $isFirst = false;
        });

        return $isEnabled;
    }

    public function enable(bool $enable): void
    {
        $this->enumerator->enumStyles(function (StyleInterface &$style) use ($enable) {
            $style->enable($enable);
        });
    }

    public function getColor(): ?RGBAColor
    {
        $color = null;
        $isFirst = true;
        $this->enumerator->enumStyles(function (StyleInterface $style) use (&$color, &$isFirst, &$hasNull) {
            if ($isFirst) {
                $rColor = $style->getColor();
                $color = $rColor != null ? $rColor->getColor() : null;
                $isFirst = false;
            } elseif ($color === null || $color !== $style->getColor()->getColor()) {
                $color = null;
            }
        });

        if ($color == null) {
            return null;
        }

        return new RGBAColor($color);
    }

    public function setColor(RGBAColor $color): void
    {
        $this->enumerator->enumStyles(function (StyleInterface &$style) use ($color) {
            $style->setColor($color);
        });
    }
}