<?php

namespace App\Model\Beverage;

class Tea extends Beverage
{
    public function __construct(string $description = 'Tea')
    {
        parent::__construct($description);
    }

    public function getCost() : float
    {
        return 30;
    }
}