<?php

namespace Tests\Unit\Machine\Common\State;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\State\SoldOutState;
use PHPUnit\Framework\TestCase;

class SoldOutStateTest extends TestCase
{
    /**
     * @var SoldOutState
     */
    private SoldOutState $state;

    /**
     * @var GumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private GumballMachineInterface $machine;

    public function testInsertQuarter(): void
    {
        $str = "You can't insert a quarter, the machine is sold out\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testEjectQuarter(): void
    {
        $str = "You can't eject, you haven't inserted a quarter yet\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testTurnCrank(): void
    {
        $str = "You turned but there's no gumballs\n";
        $this->expectOutputString($str);

        $this->state->turnCrank();
    }

    public function testDispenseEmpty(): void
    {
        $str = "No gumball dispensed\n";
        $this->expectOutputString($str);

        $this->state->dispense();
    }

    public function testToString(): void
    {
        $this->assertEquals("sold out", $this->state->toString());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->machine = $this->createMock(GumballMachineInterface::class);
        $this->state = new SoldOutState($this->machine);
    }
}
