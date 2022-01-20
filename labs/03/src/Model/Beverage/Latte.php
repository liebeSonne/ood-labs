<?php

namespace App\Model\Beverage;

class Latte extends Coffee
{
    public const STANDART = 'standart';
    public const DOUBLE = 'double';

    private string $type;

    public function __construct(string $type = self::STANDART, string $description = 'Latte')
    {
        $this->type = $type;
        $description = ucfirst($this->type) . ' ' . $description;
        parent::__construct($description);
    }

    public function getCost() : float
    {
        switch ($this->type) {
            case self::DOUBLE:
                return 130;
            case self::STANDART:
            default:
                return 90;
        }
    }
}