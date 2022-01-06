<?php

namespace App\Model\Condiment;

// Добавка из корицы
class Cinnamon extends CondimentDecorator
{
    public function getCondimentDescription() : string
    {
        return 'Cinnamon';
    }

    public function getCondimentCost() : float
    {
        return 20;
    }
}