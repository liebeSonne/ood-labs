<?php

namespace App\Machine\WithState;

use App\Machine\Common\Machine\GumballMachineUserInterface;

class GumballMachine implements GumballMachineUserInterface
{
    private MachineCore $core;

    public function __construct(int $numBalls)
    {
        $this->core = new MachineCore($numBalls);
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