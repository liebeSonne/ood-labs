<?php

namespace App\Model\Condiment;

// Шоколад
use App\Model\Beverage\BeverageInterface;

class Liquor extends CondimentDecorator
{
    public const NUTTY = 'nutty';
    public const CHOCOLATE = 'chocolate';

    private string $type;

    public function __construct(BeverageInterface $beverage, string $type = self::NUTTY)
    {
        parent::__construct($beverage);
        $this->type = $type;
    }

    public function getCondimentDescription() : string
    {
        return ucfirst($this->type) . ' Liquor';
    }

    public function getCondimentCost() : float
    {
        return 50;
    }
}