<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Шоколадная крошка
class ChocolateCrumbs extends CondimentDecorator
{
    private int $mass;

    public function __construct(BeverageInterface $beverage, int $mass)
    {
        parent::__construct($beverage);
        $this->mass = $mass;
    }

    public function getCondimentDescription() : string
    {
        return 'Chocolate crumbs ' . $this->mass . 'g';
    }

    public function getCondimentCost() : float
    {
        return 2.0 * $this->mass;
    }
}