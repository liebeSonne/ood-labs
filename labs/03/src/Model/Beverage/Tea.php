<?php

namespace App\Model\Beverage;

class Tea extends Beverage
{
    public const GREEN = 'green';
    public const BLACK = 'black';
    public const WHITE = 'white';
    public const CITRUS = 'citrus';

    private string $type;

    public function __construct(string $type = self::BLACK, string $description = 'Tea')
    {
        $this->type = $type;
        $description = ucfirst($this->type) . ' ' . $description;
        parent::__construct($description);
    }

    public function getCost() : float
    {
        return 30;
    }
}