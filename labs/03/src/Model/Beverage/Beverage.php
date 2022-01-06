<?php

namespace App\Model\Beverage;

abstract class Beverage implements BeverageInterface
{
    private string $description;

    public function __construct(string $description = '')
    {
        $this->description = $description;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    abstract public function getCost() : float;
}