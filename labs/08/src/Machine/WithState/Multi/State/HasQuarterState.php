<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class HasQuarterState implements StateInterface
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
        echo "$countQuarter Quarter returned\n";
        $countQuarter = 0;
        $this->gumballMachine->setQuarterCount($countQuarter);
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

    public function refill(int $numBalls): void
    {
        $this->gumballMachine->setBallCount($numBalls);
        if ($this->gumballMachine->getBallCount() === 0) {
            $this->gumballMachine->setSoldOutState();
        }
    }
}