<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\Common\State\StateInterface;

class NoQuarterState implements StateInterface
{
    private MultiGumballMachineInterface $gumballMachine;
    private int $countQuarter;
    private int $maxQuarter;

    public function __construct(MultiGumballMachineInterface $gumballMachine, &$countQuarter, int &$maxQuarter)
    {
        $this->gumballMachine = $gumballMachine;
        $this->countQuarter =& $countQuarter;
        $this->maxQuarter = $maxQuarter;
    }

    public function insertQuarter(): void
    {
        $this->countQuarter++;
        echo "You inserted a quarter ($this->countQuarter / $this->maxQuarter)\n";
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

    public function refill(int $numBalls): void
    {
        $this->gumballMachine->setBallCount($numBalls);
        if ($this->gumballMachine->getBallCount() === 0) {
            $this->gumballMachine->setSoldOutState();
        }
    }
}
