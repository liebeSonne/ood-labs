<?php

namespace Tests\Unit\Machine\WithState;

use App\Machine\WithState\GumballMachine;
use PHPUnit\Framework\TestCase;

class GumballMachineTest extends TestCase
{
    public function testGetCountBalls(): void
    {
        $tests = [
            [
                'count' => 0,
                'm' => new GumballMachine(-1),
            ],
            [
                'count' => 0,
                'm' => new GumballMachine(0),
            ],
            [
                'count' => 1,
                'm' => new GumballMachine(1),
            ],
            [
                'count' => 5,
                'm' => new GumballMachine(5),
            ]
        ];

        foreach ($tests as $test) {
            $this->assertEquals($test['count'], $test['m']->getBallCount());
        }
    }

    public function testReleaseBall(): void
    {
        $count = 5;
        $m = new GumballMachine($count);

        $this->expectOutputString("A gumball comes rolling out the slot...\n");

        $m->releaseBall();

        $this->assertEquals($this->getStateText(4, 'NoQuarterState'), $m->toString());
    }

    public function testReleaseBallOnNoBalls(): void
    {
        $count = 0;
        $m = new GumballMachine($count);

        $m->releaseBall();

        $this->assertEquals($this->getStateText(0, 'SoldOutState'), $m->toString());
    }

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

    /**
     * @dataProvider providerFirstMethod
     * @param array $test
     * @return void
     */
    public function testFirstMethod(array $test): void
    {
        $m = new GumballMachine($test['count']);
        $this->expectOutputString($test['str']);
        switch ($test['method']) {
            case 'insertQuarter':
                $m->insertQuarter();
                break;
            case 'ejectQuarter':
                $m->ejectQuarter();
                break;
            case 'turnCrank':
                $m->turnCrank();
                break;
            case 'releaseBall':
                $m->releaseBall();
                break;
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

    /**
     * @dataProvider providerCombinations
     * @param array $test
     * @return void
     */
    public function testCombinations(array $test): void
    {
        $m = new GumballMachine($test['count']);

        $stateText = $this->getStateText($test['count'], $test['state']);
        $this->assertEquals($stateText, $m->toString());

        $this->expectOutputString(implode($test['output']));

        foreach ($test['methods'] as $i => $method) {
            switch ($method) {
                case 'insertQuarter':
                    $m->insertQuarter();
                    break;
                case 'ejectQuarter':
                    $m->ejectQuarter();
                    break;
                case 'turnCrank':
                    $m->turnCrank();
                    break;
                case 'releaseBall':
                    $m->releaseBall();
                    break;
            }

            $newStateText = $this->getStateText($test['counts'][$i], $test['states'][$i]);
            $this->assertEquals($newStateText, $m->toString());
        }

    }

    public function providerCombinations(): array
    {
        $stateOutputs = [
            'HasQuarterState' => [
                'insertQuarter' => "You can't insert another quarter\n",
                'ejectQuarter' => "Quarter returned\n", // to setNoQuarterState
                'turnCrank' => "You turned...\n", // to setSoldState
                'dispense' => "No gumball dispensed\n",
            ],
            'NoQuarterState' => [
                'insertQuarter' => "You inserted a quarter\n", // to setHasQuarterState
                'ejectQuarter' => "You haven't inserted a quarter\n",
                'turnCrank' => "You turned but there's no quarter\n",
                'dispense' => "You need to pay first\n",
            ],
            'SoldOutState' => [
                'insertQuarter' => "You can't insert a quarter, the machine is sold out\n",
                'ejectQuarter' => "You can't eject, you haven't inserted a quarter yet\n",
                'turnCrank' => "You turned but there's no gumballs\n",
                'dispense' => "No gumball dispensed\n",
            ],
            'SoldState' => [
                'insertQuarter' => "Please wait, we're already giving you a gumball\n",
                'ejectQuarter' => "Sorry you already turned the crank\n",
                'turnCrank' => "Turning twice doesn't get you another gumball\n",
                'dispense' => "Oops, out of gumballs\n", // releaseBall, show text if count == 0 + to setSoldOutState else to setNoQuarterState
            ],
        ];
        $machineOutput = [
            'releaseBall' => "A gumball comes rolling out the slot...\n", // if count != 0
        ];

        // on turnCrank =>  turnCrank(), dispense()
        // StartState:
        //   SoldOutState if == 0
        //   NoQuarterState if > 0
        return [
            'from SoldOut no way' => [[
                // стартовые значения
                'count' => 0, 'state' => 'SoldOutState',
                // количество шаров после каждого вызванного метода
                'counts' => [0, 0, 0],
                // последовательность вызова методов
                'methods' => ['insertQuarter', 'ejectQuarter', 'turnCrank'],
                // состояние после каждого вызванного метода
                'states' => ['SoldOutState', 'SoldOutState', 'SoldOutState'],
                // массив текста на выходе
                'output' => [
                    $stateOutputs['SoldOutState']['insertQuarter'],
                    $stateOutputs['SoldOutState']['ejectQuarter'],
                    $stateOutputs['SoldOutState']['turnCrank'],
                    $stateOutputs['SoldOutState']['dispense'],
                ],
            ]],
            'from NoQuarterState no way' => [[
                'count' => 1, 'state' => 'NoQuarterState',
                'counts' => [1, 1],
                'methods' => ['ejectQuarter', 'turnCrank'],
                'states' => ['NoQuarterState', 'NoQuarterState'],
                'output' => [
                    $stateOutputs['NoQuarterState']['ejectQuarter'],
                    $stateOutputs['NoQuarterState']['turnCrank'],
                    $stateOutputs['NoQuarterState']['dispense'],
                ],
            ]],
            'from NoQuarterState with SoldState to SoldOutState' => [[
                'count' => 1, 'state' => 'NoQuarterState',
                'counts' => [1, 1, 1, 1, 0],
                'methods' => ['insertQuarter', 'insertQuarter', 'ejectQuarter', 'insertQuarter', 'turnCrank'],
                'states' => ['HasQuarterState', 'HasQuarterState', 'NoQuarterState', 'HasQuarterState', 'SoldOutState'],
                'output' => [
                    $stateOutputs['NoQuarterState']['insertQuarter'],
                    $stateOutputs['HasQuarterState']['insertQuarter'],
                    $stateOutputs['HasQuarterState']['ejectQuarter'],
                    $stateOutputs['NoQuarterState']['insertQuarter'],
                    $stateOutputs['HasQuarterState']['turnCrank'],
                    $machineOutput['releaseBall'],
                    $stateOutputs['SoldState']['dispense'],
                ],
            ]],
            'from NoQuarterState with SoldState to NoQuarterState' => [[
                'count' => 2, 'state' => 'NoQuarterState',
                'counts' => [2, 2, 2, 2, 1],
                'methods' => ['insertQuarter', 'insertQuarter', 'ejectQuarter', 'insertQuarter', 'turnCrank'],
                'states' => ['HasQuarterState', 'HasQuarterState', 'NoQuarterState', 'HasQuarterState', 'NoQuarterState'],
                'output' => [
                    $stateOutputs['NoQuarterState']['insertQuarter'],
                    $stateOutputs['HasQuarterState']['insertQuarter'],
                    $stateOutputs['HasQuarterState']['ejectQuarter'],
                    $stateOutputs['NoQuarterState']['insertQuarter'],
                    $stateOutputs['HasQuarterState']['turnCrank'],
                    $machineOutput['releaseBall'],
                ],
            ]],
        ];
    }
}