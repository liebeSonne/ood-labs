<?php

namespace App\Style;

interface StyleInterface
{
    public function isEnabled(): bool;
    public function enable(bool $enable): void;

    public function getColor(): RGBAColor;
    public function setColor(RGBAColor $color): void;
}