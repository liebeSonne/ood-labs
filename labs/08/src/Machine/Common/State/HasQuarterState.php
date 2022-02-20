<?php

namespace App\Machine\Common\State;

use App\Machine\Common\Machine\GumballMachineInterface;

class HasQuarterState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        echo "You can't insert another quarter\n";
    }

    public function ejectQuarter(): void
    {
        echo "Quarter returned\n";
        $this->gumballMachine->setNoQuarterState();
    }

    public function turnCrank(): void
    {
        echo "You turned...\n";
        $this->gumballMachine->setSoldState();
    }

    public function dispense(): void
    {
        echo "No gumball dispensed\n";
    }

    public function toString(): string
    {
        return "waiting for turn of crank";
    }
}