<?php

namespace App\Machine\Common\State;

use App\Machine\Common\Machine\GumballMachineInterface;

class NoQuarterState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        echo "You inserted a quarter\n";
        $this->gumballMachine->setHasQuarterState();
    }

    public function ejectQuarter(): void
    {
        echo "You haven't inserted a quarter\n";
    }

    public function turnCrank(): void
    {
        echo "You turned but there's no quarter\n";
    }

    public function dispense(): void
    {
        echo "You need to pay first\n";
    }

    public function toString(): string
    {
        return "waiting for quarter";
    }
}
