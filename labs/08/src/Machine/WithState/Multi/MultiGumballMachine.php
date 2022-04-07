<?php

namespace App\Machine\WithState\Multi;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\Machine\GumballMachineUserInterface;
use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\WithState\Multi\State\HasQuarterState;
use App\Machine\WithState\Multi\State\NoQuarterState;
use App\Machine\WithState\Multi\State\SoldOutState;
use App\Machine\WithState\Multi\State\SoldState;
use App\Machine\Common\State\StateInterface;

class MultiGumballMachine implements GumballMachineInterface, GumballMachineUserInterface, MultiGumballMachineInterface
{
    private int $maxQuarter = 1;
    private int $countQuarter = 0;
    private int $count = 0;
    private SoldState $soldState;
    private SoldOutState $soldOutState;
    private NoQuarterState $noQuarterState;
    private HasQuarterState $hasQuarterState;
    private StateInterface $state;

    public function __construct(int $numBalls, $maxQuarter = 5)
    {
        $this->maxQuarter = max($maxQuarter, 1);
        $numBalls = max($numBalls, 0);
        $this->count = $numBalls;
        $this->soldState = new SoldState($this);
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);

        $this->state = $this->soldOutState;
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
        $this->state->turnCrank();
        $this->state->dispense();
    }

    public function toString(): string
    {
        $str = "(\n";
        $str .= "\tMighty Gumball, Inc.\n";
        $str .= "\tC++-enabled Standing Gumball Model #2016 (with state multi)\n";
        $str .= "\tInventory: %d gumball%s\n";
        $str .= "\tInventory: %d quarter%s\n";
        $str .= "\tMachine is %s\n";
        $str .= ")\n";
        $postfix = ($this->count != 1 ? 's' : '');
        $postfix_quarter = $this->countQuarter != 1 ? 's' : '';

        return sprintf($str, $this->count, $postfix, $this->countQuarter, $postfix_quarter, $this->state->toString());
    }

    public function releaseBall(): void
    {
        if ($this->count != 0) {
            echo "A gumball comes rolling out the slot...\n";
            --$this->count;
            --$this->countQuarter;
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

    public function setBallCount(int $numBalls): void
    {
        $this->count = max($numBalls, 0);
    }

    public function getQuarterCount(): int
    {
        return $this->countQuarter;
    }

    public function setQuarterCount(int $count): void
    {
        $this->countQuarter = $count;
    }

    public function refill(int $numBalls): void
    {
        $this->state->refill($numBalls);
    }

    public function getMaxQuarterCount(): int
    {
        return $this->maxQuarter;
    }
}