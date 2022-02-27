<?php

namespace App\Machine\WithState\Multi;

use App\Machine\WithState\Multi\MultiGumballMachine;
use App\Machine\Naive\State as State;
use PHPUnit\Framework\TestCase;

class MultiGumballMachineTest extends TestCase
{
    public function testInsertQuarter(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $countQuarter = 1;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->expectOutputString("You inserted a quarter ($countQuarter / $maxQuarter)\n");

        $m->insertQuarter();

        $this->assertEquals($this->getText($countBalls, $countQuarter, State::HAS_QUARTER), $m->toString());
    }

    public function testEjectQuarter(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $countQuarter = 0;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->expectOutputString("You haven't inserted a quarter\n");
        $m->ejectQuarter();

        $this->assertEquals($this->getText($countBalls, $countQuarter, State::NO_QUARTER), $m->toString());
    }

    public function testTurnCrank(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $countQuarter = 0;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->expectOutputString("You turned but there's no quarter\n" . "You need to pay first\n");
        $m->turnCrank();

        $this->assertEquals($this->getText($countBalls, $countQuarter, State::NO_QUARTER), $m->toString());
    }

    public function testToString(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $countQuarter = 0;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->assertEquals($this->getText($countBalls, $countQuarter, State::NO_QUARTER), $m->toString());
    }

    public function testRefill(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $countQuarter = 0;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $numBalls = 5;
        $m->refill($numBalls);

        $this->assertEquals($this->getText($numBalls, $countQuarter, State::NO_QUARTER), $m->toString());
    }

    public function testRefillNull(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $countQuarter = 0;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $numBalls = 0;
        $m->refill($numBalls);

        $this->assertEquals($this->getText($numBalls, $countQuarter, State::SOLD_OUT), $m->toString());
    }

    public function testGetBallsCount(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->assertEquals($countBalls, $m->getBallCount());
    }

    public function testSetBallsCount(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $newCountBalls = 7;
        $m->setBallCount($newCountBalls);

        $this->assertEquals($newCountBalls, $m->getBallCount());
    }

    public function testGetQuarterCount(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->assertEquals(0, $m->getQuarterCount());
    }

    public function testSetQuarterCount(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $newQuarterCount = 3;
        $m->setQuarterCount($newQuarterCount);

        $this->assertEquals($newQuarterCount, $m->getQuarterCount());
    }

    public function testGetMaxQuarterCount(): void
    {
        $countBalls = 5;
        $maxQuarter = 5;
        $m = new MultiGumballMachine($countBalls, $maxQuarter);

        $this->assertEquals($maxQuarter, $m->getMaxQuarterCount());
    }

    public function getScenarios(): array
    {
        return [
            'scenario 1' =>
            [[
                'machine' => [
                    'countBalls' => 5,
                    'maxQuarter' => 5,
                ],
                'calls' => [
                    // проверяем не работающие действия без монет
                    [
                        'countBalls' => 5, 'countQuarter' => 0,
                        'action' => 'ejectQuarter', 'state' => State::NO_QUARTER,
                        'output' => "You haven't inserted a quarter\n",
                    ],
                    [
                        'countBalls' => 5, 'countQuarter' => 0,
                        'action' => 'turnCrank', 'state' => State::NO_QUARTER,
                        'output' => "You turned but there's no quarter\n" . "You need to pay first\n",
                    ],
                    // заполняем монеты на максимум
                    [
                        'countBalls' => 5, 'countQuarter' => 1,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (1 / 5)\n",
                    ],
                    [
                        'countBalls' => 5,  'countQuarter' => 2,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (2 / 5)\n",
                    ],
                    [
                        'countBalls' => 5,  'countQuarter' => 3,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (3 / 5)\n",
                    ],
                    [
                        'countBalls' => 5,  'countQuarter' => 4,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (4 / 5)\n",
                    ],
                    [
                        'countBalls' => 5,  'countQuarter' => 5,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (5 / 5)\n",
                    ],
                    [
                        'countBalls' => 5,  'countQuarter' => 5,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You can't insert another quarter (5 / 5)\n",
                    ],
                    // получаем шары
                    [
                        'countBalls' => 4,  'countQuarter' => 4,
                        'action' => 'turnCrank', 'state' => State::HAS_QUARTER,
                        'output' => "You turned...\n"
                            . "A gumball comes rolling out the slot...\n",
                    ],
                    [
                        'countBalls' => 3,  'countQuarter' => 3,
                        'action' => 'turnCrank', 'state' => State::HAS_QUARTER,
                        'output' => "You turned...\n"
                            . "A gumball comes rolling out the slot...\n",
                    ],
                    // возвращаем монеты
                    [
                        'countBalls' => 3,  'countQuarter' => 0,
                        'action' => 'ejectQuarter', 'state' => State::NO_QUARTER,
                        'output' => "3 Quarter returned\n",
                    ],
                    // получаем шар и заканчиваются монеты, вначале пополним
                    [
                        'countBalls' => 3,  'countQuarter' => 1,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (1 / 5)\n",
                    ],
                    [
                        'countBalls' => 2,  'countQuarter' => 0,
                        'action' => 'turnCrank', 'state' => State::NO_QUARTER,
                        'output' => "You turned...\n"
                            . "A gumball comes rolling out the slot...\n",
                    ],
                    // снова заполняем монетами
                    [
                        'countBalls' => 2,  'countQuarter' => 1,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (1 / 5)\n",
                    ],
                    [
                        'countBalls' => 2,  'countQuarter' => 2,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (2 / 5)\n",
                    ],
                    [
                        'countBalls' => 2,  'countQuarter' => 3,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (3 / 5)\n",
                    ],
                    [
                        'countBalls' => 2,  'countQuarter' => 4,
                        'action' => 'insertQuarter', 'state' => State::HAS_QUARTER,
                        'output' => "You inserted a quarter (4 / 5)\n",
                    ],
                    // забираем все шары
                    [
                        'countBalls' => 1,  'countQuarter' => 3,
                        'action' => 'turnCrank', 'state' => State::HAS_QUARTER,
                        'output' => "You turned...\n"
                            . "A gumball comes rolling out the slot...\n",
                    ],
                    [
                        'countBalls' => 0,  'countQuarter' => 2,
                        'action' => 'turnCrank', 'state' => State::SOLD_OUT,
                        'output' => "You turned...\n"
                            . "A gumball comes rolling out the slot...\n"
                            . "Oops, out of gumballs\n",
                    ],
                    // проверяем действия когда закончились шары
                    [
                        'countBalls' => 0,  'countQuarter' => 2,
                        'action' => 'insertQuarter', 'state' => State::SOLD_OUT,
                        'output' => "You can't insert a quarter, the machine is sold out\n",
                    ],
                    [
                        'countBalls' => 0,  'countQuarter' => 0,
                        'action' => 'ejectQuarter', 'state' => State::SOLD_OUT,
                        'output' => "2 Quarter returned\n",
                    ],
                    [
                        'countBalls' => 0,  'countQuarter' => 0,
                        'action' => 'ejectQuarter', 'state' => State::SOLD_OUT,
                        'output' => "You can't eject, you haven't inserted a quarter yet\n",
                    ],
                    [
                        'countBalls' => 0,  'countQuarter' => 0,
                        'action' => 'insertQuarter', 'state' => State::SOLD_OUT,
                        'output' => "You can't insert a quarter, the machine is sold out\n",
                    ],
                    [
                        'countBalls' => 0,  'countQuarter' => 0,
                        'action' => 'turnCrank', 'state' => State::SOLD_OUT,
                        'output' => "You turned but there's no gumballs\n"
                            . "No gumball dispensed\n",
                    ],
                ],
            ]],
        ];
    }

    /**
     * @dataProvider getScenarios
     * @param array $scenario
     * @return void
     */
    public function testScenarios(array $scenario): void
    {
        $machine = new MultiGumballMachine($scenario['machine']['countBalls'], $scenario['machine']['maxQuarter']);

        $output = '';

        foreach ($scenario['calls'] as $data) {
            $output .= $data['output'];
        }

        if (!empty($output)) {
            $this->expectOutputString($output);
        }

        foreach ($scenario['calls'] as $data)
        {
            $countBalls = $data['countBalls'];
            $countQuarter = $data['countQuarter'];
            $action = $data['action'];
            $state = $data['state'];

            switch ($action) {
                case 'turnCrank':
                    $machine->turnCrank();
                    break;
                case 'ejectQuarter':
                    $machine->ejectQuarter();
                    break;
                case 'insertQuarter':
                    $machine->insertQuarter();
                    break;
            }

            $text = $this->getText($countBalls, $countQuarter, $state);
            $this->assertEquals($text, $machine->toString());
        }

    }

    private function getText(int $countBalls, int $countQuarter, string $state): string {
        $str = "(\n";
        $str .= "\tMighty Gumball, Inc.\n";
        $str .= "\tC++-enabled Standing Gumball Model #2016 (with state multi)\n";
        $str .= "\tInventory: %d gumball%s\n";
        $str .= "\tInventory: %d quarter%s\n";
        $str .= "\tMachine is %s\n";
        $str .= ")\n";

        $postfix = $countBalls != 1 ? 's' : '';
        $postfix_quarter = $countQuarter != 1 ? 's' : '';

        return sprintf($str, $countBalls, $postfix, $countQuarter, $postfix_quarter, $this->getStateText($state));
    }

    private function getStateText(string $state): string
    {
        switch ($state) {
            case State::SOLD_OUT:
                $str = 'sold out';
                break;
            case State::NO_QUARTER:
                $str = 'waiting for quarter';
                break;
            case State::HAS_QUARTER:
                $str = 'waiting for turn of crank';
                break;
            default:
                $str = 'delivering a gumball';
        }
        return $str;
    }
}