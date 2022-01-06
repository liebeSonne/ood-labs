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

    public function getDescription() : string
    {
        return $this->beverage->getDescription() . ", " . $this->getCondimentDescription();
    }

    public function getCost() : float
    {
        return $this->beverage->getCost() + $this->getCondimentCost();
    }

    abstract public function getCondimentDescription() : string;
    abstract public function getCondimentCost() : float;
}