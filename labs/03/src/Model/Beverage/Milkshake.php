<?php

namespace App\Model\Beverage;

class Milkshake extends Beverage
{
    public function __construct(string $description = 'Milkshake')
    {
        parent::__construct($description);
    }

    public function getCost() : float
    {
        return 80;
    }
}