<?php

namespace App\Model\Condiment;

// Добавка из корицы
class Cinnamon extends CondimentDecorator
{
    protected function getCondimentDescription() : string
    {
        return 'Cinnamon';
    }

    protected function getCondimentCost() : float
    {
        return 20;
    }
}