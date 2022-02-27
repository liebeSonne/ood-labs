<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\WithState\Multi\State\SoldState;
use PHPUnit\Framework\TestCase;

class SoldStateTest extends TestCase
{
    /**
     * @var SoldState
     */
    private SoldState $state;

    /**
     * @var MultiGumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MultiGumballMachineInterface $machine;

    public function testInsertQuarter(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 5;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "You can't insert another quarter ($quarterCount / $maxQuarterCount)\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testInsertQuarterAdd(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 2;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);
        $quarterCount++;

        $str = "You inserted a quarter ($quarterCount / $maxQuarterCount)\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testEjectQuarterNull(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 0;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "You haven't inserted a quarter\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testEjectQuarter(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 2;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "$quarterCount Quarter returned\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testTurnCrank(): void
    {
        $str = "Turning twice doesn't get you another gumball\n";
        $this->expectOutputString($str);

        $this->state->turnCrank();
    }

    public function testDispenseEmpty(): void
    {
        $countBalls = 0;
        $quarterCount = 2;
        $this->machine->method('getBallCount')->willReturn($countBalls);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "Oops, out of gumballs\n";
        $this->expectOutputString($str);
        $this->machine->expects($this->once())->method('releaseBall');
        $this->machine->expects($this->once())->method('setSoldOutState');

        $this->state->dispense();
    }

    public function testDispenseHasQuarter(): void
    {
        $countBalls = 3;
        $quarterCount = 2;
        $this->machine->method('getBallCount')->willReturn($countBalls);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $this->machine->expects($this->once())->method('releaseBall');
        $this->machine->expects($this->once())->method('setHasQuarterState');

        $this->state->dispense();
    }

    public function testDispenseNoQuarter(): void
    {
        $countBalls = 3;
        $quarterCount = 0;
        $this->machine->method('getBallCount')->willReturn($countBalls);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $this->machine->expects($this->once())->method('releaseBall');
        $this->machine->expects($this->once())->method('setNoQuarterState');

        $this->state->dispense();
    }

    public function testToString(): void
    {
        $this->assertEquals("delivering a gumball", $this->state->toString());
    }

    public function testRefill(): void
    {
        $str = "Can't refill when sold...\n";
        $this->expectOutputString($str);

        $numBalls = 5;
        $this->state->refill($numBalls);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->machine = $this->createMock(MultiGumballMachineInterface::class);
        $this->state = new SoldState($this->machine);
    }
}
