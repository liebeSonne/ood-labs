<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Добавка "Сироп"
class Syrup extends CondimentDecorator
{
    private string $type;

    public function __construct(BeverageInterface $beverage, string $type = SyrupType::MAPLE)
    {
        parent::__construct($beverage);
        $this->type = $type;
    }

    public function getCondimentDescription() : string
    {
        return ($this->type === SyrupType::CHOCOLATE ? 'Chocolate' : 'Maple') . ' syrup';
    }

    public function getCondimentCost() : float
    {
        return 15;
    }
}