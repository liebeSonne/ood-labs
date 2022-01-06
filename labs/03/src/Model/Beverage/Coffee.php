<?php

namespace App\Model\Beverage;

class Coffee extends Beverage
{
    public function __construct(string $description = 'Coffee')
    {
        parent::__construct($description);
    }

    public function getCost() : float
    {
        return 60;
    }
}