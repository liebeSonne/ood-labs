<?php

namespace App\Machine\Common\State;

use App\Machine\Common\Machine\GumballMachineInterface;

class SoldState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        echo "Please wait, we're already giving you a gumball\n";
    }

    public function ejectQuarter(): void
    {
        echo "Sorry you already turned the crank\n";
    }

    public function turnCrank(): void
    {
        echo "Turning twice doesn't get you another gumball\n";
    }

    public function dispense(): void
    {
        $this->gumballMachine->releaseBall();
        if ($this->gumballMachine->getBallCount() === 0) {
            echo "Oops, out of gumballs\n";
            $this->gumballMachine->setSoldOutState();
        } else {
            $this->gumballMachine->setNoQuarterState();
        }
    }

    public function toString(): string
    {
        return "delivering a gumball";
    }
}