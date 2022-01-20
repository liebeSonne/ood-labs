<?php

namespace App\Model\Beverage;

class Milkshake extends Beverage
{
    public const SMALL = 'small';
    public const MEDIUM = 'medium';
    public const LARGE = 'large';

    private string $type;

    public function __construct(string $type = self::LARGE, string $description = 'Milkshake')
    {
        $this->type = $type;
        $description = ucfirst($this->type) . ' ' . $description;
        parent::__construct($description);
    }

    public function getCost() : float
    {
        switch ($this->type) {
            case self::SMALL:
                return 50;
            case self::MEDIUM:
                return 60;
            case self::LARGE:
            default:
                return 80;
        }
    }
}