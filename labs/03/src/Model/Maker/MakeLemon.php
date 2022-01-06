<?php

namespace App\Model\Maker;

use App\Model\Beverage\BeverageInterface;
use App\Model\Condiment\Lemon;

/**
 * Функциональный объект, создающий лимонную добавку
 */
class MakeLemon
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function create(BeverageInterface $beverage) : BeverageInterface
    {
        return new Lemon($beverage, $this->quantity);
    }
}