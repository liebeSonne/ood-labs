<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Кокосовая стружка
class CoconutFlakes extends CondimentDecorator
{
    private int $mass;

    public function __construct(BeverageInterface $beverage, int $mass)
    {
        parent::__construct($beverage);
        $this->mass = $mass;
    }

    public function getCondimentDescription() : string
    {
        return 'Coconut flakes ' . $this->mass . 'g';
    }

    public function getCondimentCost() : float
    {
        return 1.0 * $this->mass;
    }
}