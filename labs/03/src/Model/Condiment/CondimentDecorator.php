<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Базовый декоратор "Добавка к напитку". Также является напитком
abstract class CondimentDecorator implements BeverageInterface
{
    private BeverageInterface $beverage;

    public function __construct(BeverageInterface $beverage)
    {
        $this->beverage = $beverage;
    }

    final public function getDescription() : string
    {
        return $this->beverage->getDescription() . ", " . $this->getCondimentDescription();
    }

    final public function getCost() : float
    {
        return $this->beverage->getCost() + $this->getCondimentCost();
    }
    
    abstract protected function getCondimentDescription() : string;
    abstract protected function getCondimentCost() : float;
}