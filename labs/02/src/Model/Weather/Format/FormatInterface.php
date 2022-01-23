<?php

namespace App\Model\Weather\Format;

interface FormatInterface
{
    public function format(float $value): string;
}