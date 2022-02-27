<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class SoldOutState implements StateInterface
{
    private MultiGumballMachineInterface $gumballMachine;

    public function __construct(MultiGumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        echo "You can't insert a quarter, the machine is sold out\n";
    }

    public function ejectQuarter(): void
    {
        $countQuarter = $this->gumballMachine->getQuarterCount();
        if ($countQuarter > 0) {
            echo "$countQuarter Quarter returned\n";
            $countQuarter = 0;
            $this->gumballMachine->setQuarterCount($countQuarter);
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

    public function refill(int $numBalls): void
    {
        $this->gumballMachine->setBallCount($numBalls);
        if ($this->gumballMachine->getBallCount() > 0) {
            if ($this->gumballMachine->getQuarterCount() > 0) {
                $this->gumballMachine->setHasQuarterState();
            } else {
                $this->gumballMachine->setNoQuarterState();
            }
        }
    }
}