<?php

namespace App\Model\Condiment;

use App\Model\Beverage\BeverageInterface;

// Добавка "Кубики льда". Определяется типом и количеством кубиков, что влияет на стоимость и описание
class IceCubes extends CondimentDecorator
{
    public const DRY = 'dry'; // Сухой лед (для суровых сибирских мужиков)
    public const WATER = 'water'; // Обычные кубики из воды

    private int $quantity;
    private string $type;

    public function __construct(BeverageInterface $beverage, int $quantity = 1, string $type = self::WATER)
    {
        parent::__construct($beverage);
        $this->quantity = $quantity;
        $this->type = $type;
    }

    public function getCondimentDescription() : string
    {
        return ($this->type === self::DRY ? 'Dry' : 'Water') . ' ice cubes x ' . $this->quantity;
    }

    public function getCondimentCost() : float
    {
        // Чем больше кубиков, тем больше стоимость.
        // Сухой лед стоит дороже
        return ($this->type === self::DRY ? 10 : 5) * $this->quantity;
    }
}