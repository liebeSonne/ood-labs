<?php

namespace App\Model\Condiment;

// Сливки
class Cream extends CondimentDecorator
{
    public function getCondimentDescription() : string
    {
        return 'Cream';
    }

    public function getCondimentCost() : float
    {
        return 25;
    }
}