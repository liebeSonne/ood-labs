<?php

namespace App\Machine\WithState\Multi;

use App\Machine\Common\Machine\GumballMachineUserInterface;

class MultiGumballMachine implements GumballMachineUserInterface
{
    private MultiGumballMachineCore $core;

    public function __construct(int $numBalls, int $maxQuarter = 5)
    {
        $this->core = new MultiGumballMachineCore($numBalls, $maxQuarter);
    }

    public function insertQuarter(): void
    {
        $this->core->insertQuarter();
    }

    public function ejectQuarter(): void
    {
        $this->core->ejectQuarter();
    }

    public function turnCrank(): void
    {
        $this->core->turnCrank();
    }

    public function toString(): string
    {
        return $this->core->toString();
    }

    public function refill(int $numBalls): void
    {
        $this->core->refill($numBalls);
    }
}