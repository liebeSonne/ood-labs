<?php

namespace App\Model\Beverage;

class Cappuccino extends Coffee
{
    const STANDART = 'standart';
    const DOUBLE = 'double';

    private string $type;

    public function __construct(string $type = self::STANDART, string $description = 'Cappuccino')
    {
        $this->type = $type;
        $description = ucfirst($this->type) . ' ' . $description;
        parent::__construct($description);
    }

    public function getCost() : float
    {
        switch ($this->type) {
            case self::DOUBLE:
                return 120;
            case self::STANDART:
            default:
                return 80;
        }
    }
}