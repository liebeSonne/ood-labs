<?php

namespace App\Machine\Naive\Multi;

use App\Machine\Common\Machine\GumballMachineStateInterface;
use App\Machine\Naive\State;

class MultiGumballMachine implements GumballMachineStateInterface
{
    private int $maxQuarter = 1;
    private int $countQuarter = 0; // Количество монеток
    private int $count; // Количество шариков
    private string $state = State::SOLD_OUT;

    public function __construct(int $count, int $maxQuarter = 5)
    {
        $this->maxQuarter = max($maxQuarter, 1);
        $count = max($count, 0);
        $this->count = $count;
        $this->state = $count > 0 ? State::NO_QUARTER : State::SOLD_OUT;
    }

    public function insertQuarter(): void
    {
        switch ($this->state) {
            case State::SOLD_OUT:
                echo "You can't insert a quarter, the machine is sold out\n";
                break;
            case State::NO_QUARTER:
                $this->countQuarter++;
                echo "You inserted a quarter ($this->countQuarter / $this->maxQuarter)\n";
                $this->state = State::HAS_QUARTER;
                break;
            case State::HAS_QUARTER:
            case State::SOLD:
                if ($this->countQuarter < $this->maxQuarter) {
                    $this->countQuarter++;
                    echo "You inserted a quarter ($this->countQuarter / $this->maxQuarter)\n";
                } else {
                    echo "You can't insert another quarter ($this->countQuarter / $this->maxQuarter)\n";
                }
                break;
        }
    }

    public function ejectQuarter(): void
    {
        switch ($this->state) {
            case State::SOLD_OUT:
                if ($this->countQuarter > 0) {
                    echo "$this->countQuarter Quarter returned\n";
                    $this->countQuarter = 0;
                } else {
                    echo "You can't eject, you haven't inserted a quarter yet\n";
                }
                break;
            case State::NO_QUARTER:
                echo "You haven't inserted a quarter\n";
                break;
            case State::HAS_QUARTER:
                echo "$this->countQuarter Quarter returned\n";
                $this->countQuarter = 0;
                $this->state = State::NO_QUARTER;
                break;
            case State::SOLD:
                if ($this->countQuarter > 0) {
                    echo "$this->countQuarter Quarter returned\n";
                    $this->countQuarter = 0;
                } else {
                    echo "You haven't inserted a quarter\n";
                }
                break;
        }
    }

    public function turnCrank(): void
    {
        switch ($this->state) {
            case State::SOLD_OUT:
                echo "You can't eject, you haven't inserted a quarter yet\n";
                break;
            case State::NO_QUARTER:
                echo "You turned but there's no quarter\n";
                break;
            case State::HAS_QUARTER:
                echo "You turned...\n";
                $this->state = State::SOLD;
                $this->dispense();
                break;
            case State::SOLD:
                echo "Turning twice doesn't get you another gumball\n";
                break;
        }
    }

    public function refill(int $numBalls): void
    {
        switch ($this->state) {
            case State::SOLD:
                echo "Can't refill when sold...\n";
                break;
            case State::SOLD_OUT:
                $this->count = max($numBalls, 0);
                if ($this->count > 0) {
                    if ($this->countQuarter > 0) {
                        $this->state = State::HAS_QUARTER;
                    } else {
                        $this->state = State::NO_QUARTER;
                    }
                }
                break;
            case State::NO_QUARTER:
            case State::HAS_QUARTER:
                $this->count = max($numBalls, 0);
                if ($this->count === 0) {
                    $this->state = State::SOLD_OUT;
                }
                break;
        }
    }

    public function toString(): string
    {
        $state = '';
        switch ($this->state) {
            case State::SOLD_OUT:
                $state = 'sold out';
                break;
            case State::NO_QUARTER:
                $state = 'waiting for quarter';
                break;
            case State::HAS_QUARTER:
                $state = 'waiting for turn of crank';
                break;
            default:
                $state = 'delivering a gumball';
        }

        $str = "(\n";
        $str .= "\tMighty Gumball, Inc.\n";
        $str .= "\tC++-enabled Standing Gumball Model #2016\n";
        $str .= "\tInventory: %d gumball%s\n";
        $str .= "\tInventory: %d quarter%s\n";
        $str .= "\tMachine is %s\n";
        $str .= ")\n";

        $postfix = $this->count != 1 ? 's' : '';
        $postfix_quarter = $this->countQuarter != 1 ? 's' : '';

        return sprintf($str, $this->count, $postfix, $this->countQuarter, $postfix_quarter, $state);
    }

    private function dispense(): void
    {
        switch ($this->state) {
            case State::SOLD:
                echo "A gumball comes rolling out the slot\n";
                --$this->count;
                --$this->countQuarter;
                if ($this->count === 0) {
                    echo  "Oops, out of gumballs\n";
                    $this->state = State::SOLD_OUT;
                } elseif ($this->countQuarter > 0) {
                    $this->state = State::HAS_QUARTER;
                } else {
                    $this->state = State::NO_QUARTER;
                }
                break;
            case State::NO_QUARTER:
                echo "You need to pay first\n";
                break;
            case State::SOLD_OUT:
            case State::HAS_QUARTER:
                echo "No gumball dispensed\n";
                break;
        }
    }
}