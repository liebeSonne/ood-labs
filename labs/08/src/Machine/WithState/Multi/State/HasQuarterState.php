<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class HasQuarterState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;
    private int $countQuarter;
    private int $maxQuarter;

    public function __construct(GumballMachineInterface $gumballMachine, int &$countQuarter, int &$maxQuarter)
    {
        $this->gumballMachine = $gumballMachine;
        $this->countQuarter =& $countQuarter;
        $this->maxQuarter = $maxQuarter;
    }

    public function insertQuarter(): void
    {
        if ($this->countQuarter < $this->maxQuarter) {
            $this->countQuarter++;
            echo "You inserted a quarter ($this->countQuarter / $this->maxQuarter)\n";
        } else {
            echo "You can't insert another quarter ($this->countQuarter / $this->maxQuarter)\n";
        }
    }

    public function ejectQuarter(): void
    {
        echo "$this->countQuarter Quarter returned\n";
        $this->countQuarter = 0;
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