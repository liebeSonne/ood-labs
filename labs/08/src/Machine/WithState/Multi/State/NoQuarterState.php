<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class NoQuarterState implements StateInterface
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
            $this->gumballMachine->setHasQuarterState();
        } else {
            echo "You can't insert another quarter ($countQuarter / $maxQuarter)\n";
        }
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

    public function refill(int $numBalls): void
    {
        $this->gumballMachine->setBallCount($numBalls);
        if ($this->gumballMachine->getBallCount() === 0) {
            $this->gumballMachine->setSoldOutState();
        }
    }
}
