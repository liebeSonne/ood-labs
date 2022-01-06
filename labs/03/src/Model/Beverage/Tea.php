<?php

namespace App\Model\Beverage;

class Tea extends Beverage
{
    const GREEN = 'green';
    const BLACK = 'black';
    const WHITE = 'white';
    const CITRUS = 'citrus';

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