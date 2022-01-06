<?php

namespace App\Model\Beverage;

class Cappuccino extends Coffee
{
    public function __construct(string $description = 'Cappuccino')
    {
        parent::__construct($description);
    }

    public function getCost() : float
    {
        return 80;
    }
}