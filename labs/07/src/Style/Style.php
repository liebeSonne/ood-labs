<?php

namespace App\Style;

class Style implements StyleInterface
{
    private bool $enabled = true;
    private RGBAColor $color;

    public function __construct()
    {
        $this->color = new RGBAColor(0x000000FF);
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function enable(bool $enable): void
    {
        $this->enabled = $enable;
    }

    public function getColor(): RGBAColor
    {
        return $this->color;
    }

    public function setColor(RGBAColor $color): void
    {
        $this->color = $color;
    }
}