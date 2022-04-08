<?php

namespace Tests\Unit\Machine\WithState;

use App\Machine\WithState\GumballMachine;
use PHPUnit\Framework\TestCase;

class GumballMachineTest extends TestCase
{
    public function testToString(): void
    {
        $numBalls = 5;

        $str = "(\n";
        $str .= "Mighty Gumball, Inc.\n";
        $str .= "C++-enabled Standing Gumball Model #2016 (with state)\n";
        $str .= "Inventory: %d gumball%s\n";
        $str .= "Machine is %s\n";
        $str .= ")\n";

        $tests = [
            [
                'count' => 0,
                'str' => sprintf($str, 0, 's', 'sold out'),
            ],
            [
                'count' => 5,
                'str' => sprintf($str, 5, 's', 'waiting for quarter'),
            ],
        ];

        foreach ($tests as $test) {
            $m = new GumballMachine($test['count']);
            $this->assertEquals($test['str'], $m->toString());
        }
    }

    public function providerFirstMethod(): array
    {
        return [
            [[
                'count' => 0,
                'str' => "You can't insert a quarter, the machine is sold out\n",
                'method' => 'insertQuarter',
            ]],
            [[
                'count' => 1,
                'str' => "You inserted a quarter\n",
                'method' => 'insertQuarter',
            ]],
            [[
                'count' => 5,
                'str' => "You inserted a quarter\n",
                'method' => 'insertQuarter',
            ]],
            [[
                'count' => 0,
                'str' => "You can't eject, you haven't inserted a quarter yet\n",
                'method' => 'ejectQuarter',
            ]],
            [[
                'count' => 1,
                'str' => "You haven't inserted a quarter\n",
                'method' => 'ejectQuarter',
            ]],
            [[
                'count' => 0,
                'str' => "You turned but there's no gumballs\n" . "No gumball dispensed\n",
                'method' => 'turnCrank',
            ]],
            [[
                'count' => 1,
                'str' => "You turned but there's no quarter\n" . "You need to pay first\n",
                'method' => 'turnCrank',
            ]],
            [[
                'count' => 5,
                'str' => "A gumball comes rolling out the slot...\n",
                'method' => 'releaseBall',
            ]],
        ];
    }

    private function getStateText($count, $state): string
    {
        $stateTexts = [
            'HasQuarterState' => "waiting for turn of crank",
            'NoQuarterState' => "waiting for quarter",
            'SoldOutState' => "sold out",
            'SoldState' => "delivering a gumball",
        ];
        $stateText = $stateTexts[$state];
        $str = "(\n";
        $str .= "Mighty Gumball, Inc.\n";
        $str .= "C++-enabled Standing Gumball Model #2016 (with state)\n";
        $str .= "Inventory: %d gumball%s\n";
        $str .= "Machine is %s\n";
        $str .= ")\n";
        $postfix = ($count != 1 ? 's' : '');
        return sprintf($str, $count, $postfix, $stateText);
    }

    public function testRefill(): void
    {
        $count = 0;
        $m = new GumballMachine($count);

        $numBalls = 5;
        $m->refill($numBalls);

        $this->assertEquals($this->getStateText($numBalls, 'NoQuarterState'), $m->toString());
    }

    public function testRefillNull(): void
    {
        $count = 5;
        $m = new GumballMachine($count);

        $numBalls = 0;
        $m->refill($numBalls);

        $this->assertEquals($this->getStateText($numBalls, 'SoldOutState'), $m->toString());
    }
}