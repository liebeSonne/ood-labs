<?php

namespace App\Model\Condiment;

// Шоколад
use App\Model\Beverage\BeverageInterface;

class Chocolate extends CondimentDecorator
{
    private const MAX_QUANTITY = 5;

    private int $quantity;

    public function __construct(BeverageInterface $beverage, int $quantity = 1)
    {
        parent::__construct($beverage);
        $this->quantity = min($quantity, self::MAX_QUANTITY);
    }

    protected function getCondimentDescription() : string
    {
        return 'Chocolate x ' . $this->quantity . ' slices';
    }

    protected function getCondimentCost() : float
    {
        return 10 * $this->quantity;
    }
}