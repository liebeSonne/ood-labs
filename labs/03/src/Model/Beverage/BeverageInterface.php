<?php

namespace App\Model\Beverage;

interface BeverageInterface
{
    public function getDescription() : string;
    public function getCost() : float;
}