<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Лимонная добавка
class Lemon extends CondimentDecorator
{
    private int $quantity;

    public function __construct(BeverageInterface $beverage, int $quantity = 1)
    {
        parent::__construct($beverage);
        $this->quantity = $quantity;
    }

    protected function getCondimentDescription() : string
    {
        return 'Lemon x ' . $this->quantity;
    }

    protected function getCondimentCost() : float
    {
        return 10 * $this->quantity;
    }
}