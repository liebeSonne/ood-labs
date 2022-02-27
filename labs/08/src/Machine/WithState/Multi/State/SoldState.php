<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class SoldState implements StateInterface
{
    private MultiGumballMachineInterface $gumballMachine;

    public function __construct(MultiGumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        $maxQuarter = $this->gumballMachine->getMaxQuarterCount();
        $countQuarter = $this->gumballMachine->getQuarterCount();
        if ($countQuarter < $maxQuarter) {
            $countQuarter++;
            $this->gumballMachine->setQuarterCount($countQuarter);
            echo "You inserted a quarter ($countQuarter / $maxQuarter)\n";
        } else {
            echo "You can't insert another quarter ($countQuarter / $maxQuarter)\n";
        }
    }

    public function ejectQuarter(): void
    {
        $countQuarter = $this->gumballMachine->getQuarterCount();
        if ($countQuarter > 0) {
            echo "$countQuarter Quarter returned\n";
            $countQuarter = 0;
            $this->gumballMachine->setQuarterCount($countQuarter);
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
        $countQuarter = $this->gumballMachine->getQuarterCount();
        if ($this->gumballMachine->getBallCount() === 0) {
            echo "Oops, out of gumballs\n";
            $this->gumballMachine->setSoldOutState();
        } elseif ($countQuarter > 0) {
            $this->gumballMachine->setHasQuarterState();
        } else {
            $this->gumballMachine->setNoQuarterState();
        }
    }

    public function toString(): string
    {
        return "delivering a gumball";
    }

    public function refill(int $numBalls): void
    {
        echo "Can't refill when sold...\n";
    }
}