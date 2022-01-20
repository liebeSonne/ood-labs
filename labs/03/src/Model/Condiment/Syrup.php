<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Добавка "Сироп"
class Syrup extends CondimentDecorator
{
    public const CHOCOLATE = 'Chocolate'; // Шоколадный
    public const MAPLE = 'Maple'; // Кленовый

    private string $type;

    public function __construct(BeverageInterface $beverage, string $type = self::MAPLE)
    {
        parent::__construct($beverage);
        $this->type = $type;
    }

    public function getCondimentDescription() : string
    {
        return ($this->type === self::CHOCOLATE ? 'Chocolate' : 'Maple') . ' syrup';
    }

    public function getCondimentCost() : float
    {
        return 15;
    }
}