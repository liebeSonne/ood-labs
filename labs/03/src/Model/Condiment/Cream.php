<?php

namespace App\Model\Condiment;

// Сливки
class Cream extends CondimentDecorator
{
    protected function getCondimentDescription() : string
    {
        return 'Cream';
    }

    protected function getCondimentCost() : float
    {
        return 25;
    }
}