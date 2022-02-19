<?php

namespace App\Style;

interface StyleStrokeInterface extends StyleInterface
{
    public function getSize(): float;
    public function setSize(float $size): void;
}
