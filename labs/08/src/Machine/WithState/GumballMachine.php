<?php

namespace App\Machine\WithState;

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
    private SoldState $soldState;
    private SoldOutState $soldOutState;
    private NoQuarterState $noQuarterState;
    private HasQuarterState $hasQuarterState;
    private StateInterface $state;

    public function __construct(int $numBalls)
    {
        $this->count = $numBalls;
        $this->soldState = new SoldState($this);
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);

        if ($this->count > 0) {
            $this->state = $this->noQuarterState;
        }
    }

    public function insertQuarter(): void
    {
        $this->state->insertQuarter();
    }

    public function ejectQuarter(): void
    {
        $this->state->ejectQuarter();
    }

    public function turnCrank(): void
    {
        $this->state->insertQuarter();
        $this->state->dispense();
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
        return sprintf($str, $this->count, $postfix, $this->state->toString());
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
        $this->state = $this->soldOutState;
    }

    public function setNoQuarterState(): void
    {
        $this->state = $this->noQuarterState;
    }

    public function setSoldState(): void
    {
        $this->state = $this->soldState;
    }

    public function setHasQuarterState(): void
    {
        $this->state = $this->hasQuarterState;
    }
}