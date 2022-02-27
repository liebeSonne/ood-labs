<?php

namespace App\Machine\DynamicState;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\Machine\GumballMachineTypeInterface;
use App\Machine\Common\State\HasQuarterState;
use App\Machine\Common\State\NoQuarterState;
use App\Machine\Common\State\SoldOutState;
use App\Machine\Common\State\SoldState;
use App\Machine\Common\State\StateInterface;

class GumballMachine implements GumballMachineInterface, GumballMachineTypeInterface
{
    private int $count = 0;
    private StateInterface $currentState;

    public function __construct(int $numBalls)
    {
        $numBalls = max($numBalls, 0);
        $this->count = $numBalls;
        if ($this->count > 0) {
            $this->setNoQuarterState();
        } else {
            $this->setSoldOutState();
        }
    }

    public function insertQuarter(): void
    {
        $this->currentState->insertQuarter();
    }

    public function ejectQuarter(): void
    {
        $this->currentState->ejectQuarter();
    }

    public function turnCrank(): void
    {
        $this->currentState->turnCrank();
        $this->currentState->dispense();
    }

    public function toString(): string
    {
        $str = "(\n";
        $str .= "Mighty Gumball, Inc.\n";
        $str .= "C++-enabled Standing Gumball Model #2016 (with state)\n";
        $str .= "Inventory: %d gumball%s\n";
        $str .= "Machine is %s\n";
        $str .= ")\n";
        $postfix = ($this->count != 1 ? 's' : '');
        return sprintf($str, $this->count, $postfix, $this->currentState->toString());
    }

    public function releaseBall(): void
    {
        if ($this->count != 0) {
            echo "A gumball comes rolling out the slot...\n";
            --$this->count;
        }
    }

    public function getBallCount(): int
    {
        return $this->count;
    }

    public function setSoldOutState(): void
    {
        $this->currentState = new SoldOutState($this);
    }

    public function setNoQuarterState(): void
    {
        $this->currentState = new NoQuarterState($this);
    }

    public function setSoldState(): void
    {
        $this->currentState = new SoldState($this);
    }

    public function setHasQuarterState(): void
    {
        $this->currentState = new HasQuarterState($this);
    }

    public function setBallCount(int $numBalls): void
    {
        $this->count = max($numBalls, 0);
    }

    public function refill(int $numBalls): void
    {
        $this->currentState->refill($numBalls);
    }
}
