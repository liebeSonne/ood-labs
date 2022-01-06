<?php

namespace App\Model\Beverage;

class Latte extends Coffee
{
    public function __construct(string $description = 'Latte')
    {
        parent::__construct($description);
    }

    public function getCost() : float
    {
        return 90;
    }
}