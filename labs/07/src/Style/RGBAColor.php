<?php

namespace App\Style;

class RGBAColor
{
    private int $color;

    public function __construct(int $color = 0x000000FF)
    {
        $this->setColor($color);
    }

    public function setColor(int $color): void
    {
        $this->color = $color;
    }

    public function getColor(): int
    {
        return $this->color;
    }

    public function getRGBA(): array
    {
        $r = ($this->color >> 16) & 0xFF;
        $g = ($this->color >> 8) & 0xFF;
        $b = $this->color & 0xFF;
        $a = ($this->color & 0x7F000000) >> 24;

        return [
            'r' => $r,
            'g' => $g,
            'b' => $b,
            'a' => $a,
        ];
    }

    public function setRGBA(float $r, float $g, float $b, float $a): void
    {
        $this->color = ($r << 24) + ($g << 16) + ($b << 8) + ($a);
    }

    public function getHEX(): string
    {
        return "#" . substr("00000000" . dechex($this->color),-8);
    }
}