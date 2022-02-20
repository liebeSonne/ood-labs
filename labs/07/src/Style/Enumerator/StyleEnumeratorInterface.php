<?php

namespace App\Style\Enumerator;

interface StyleEnumeratorInterface
{
    public function enumStyles(callable $callback): void;
}