<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\WithState\Multi\State\NoQuarterState;
use PHPUnit\Framework\TestCase;

class NoQuartedStateTest extends TestCase
{
    /**
     * @var NoQuarterState
     */
    private NoQuarterState $state;

    /**
     * @var MultiGumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MultiGumballMachineInterface $machine;

    public function testInsertQuarter(): void
    {
        $maxQuarterCount = 0;
        $quarterCount = 0;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);
        $quarterCount++;

        $str = "You inserted a quarter ($quarterCount / $maxQuarterCount)\n";
        $this->expectOutputString($str);
        $this->machine->expects($this->once())->method('setHasQuarterState');

        $this->state->insertQuarter();
    }

    public function testEjectQuarter(): void
    {
        $str = "You haven't inserted a quarter\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testTurnCrank(): void
    {
        $str = "You turned but there's no quarter\n";
        $this->expectOutputString($str);

        $this->state->turnCrank();
    }

    public function testDispenseEmpty(): void
    {

        $str = "You need to pay first\n";
        $this->expectOutputString($str);

        $this->state->dispense();
    }

    public function testToString(): void
    {
        $this->assertEquals("waiting for quarter", $this->state->toString());
    }



    public function testRefill(): void
    {
        $numBalls = 5;

        $this->machine->method('getBallCount')->willReturn($numBalls);

        $this->machine->expects($this->once())->method('getBallCount');

        $this->state->refill($numBalls);
    }

    public function testRefillNull(): void
    {
        $numBalls = 0;

        $this->machine->method('getBallCount')->willReturn($numBalls);

        $this->machine->expects($this->once())->method('getBallCount');
        $this->machine->expects($this->once())->method('setSoldOutState');

        $this->state->refill($numBalls);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->machine = $this->createMock(MultiGumballMachineInterface::class);
        $this->state = new NoQuarterState($this->machine);
    }
}
