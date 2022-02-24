<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class SoldOutState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;
    private int $countQuarter;

    public function __construct(GumballMachineInterface $gumballMachine, int &$countQuarter)
    {
        $this->gumballMachine = $gumballMachine;
        $this->countQuarter =& $countQuarter;
    }

    public function insertQuarter(): void
    {
        echo "You can't insert a quarter, the machine is sold out\n";
    }

    public function ejectQuarter(): void
    {
        if ($this->countQuarter > 0) {
            echo "$this->countQuarter Quarter returned\n";
            $this->countQuarter = 0;
        } else {
            echo "You can't eject, you haven't inserted a quarter yet\n";
        }
    }

    public function turnCrank(): void
    {
        echo "You turned but there's no gumballs\n";
    }

    public function dispense(): void
    {
        echo "No gumball dispensed\n";
    }

    public function toString(): string
    {
        return "sold out";
    }
}