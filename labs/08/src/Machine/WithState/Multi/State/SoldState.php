<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class SoldState implements StateInterface
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
            echo "You can't insert another quarter ($this->count_Quarter, $this->maxQuarter)\n";
        }
    }

    public function ejectQuarter(): void
    {
        if ($this->countQuarter > 0) {
            echo "$this->countQuarter Quarter returned\n";
            $this->countQuarter = 0;
        } else {
            echo "You haven't inserted a quarter\n";
        }
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
        } elseif ($this->countQuarter > 0) {
            $this->gumballMachine->setHasQuarterState();
        } else {
            $this->gumballMachine->setNoQuarterState();
        }
    }

    public function toString(): string
    {
        return "delivering a gumball";
    }
}