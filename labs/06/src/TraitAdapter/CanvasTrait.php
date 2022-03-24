<?php

namespace App\TraitAdapter;

trait CanvasTrait
{
    public function moveTo(int $x, int $y): void
    {
        echo "MoveTo ($x, $y)\n";
    }

    public function lineTo(int $x, int $y): void
    {
        echo "LineTo ($x, $y)\n";
    }
}