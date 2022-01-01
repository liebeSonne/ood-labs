<?php

namespace App\Model\Duck;

use App\Behavior\Dance\IDanceBehavior;
use App\Behavior\Fly\IFlyBehavior;
use App\Behavior\Quack\IQuackBehavior;

class Duck
{
    private IFlyBehavior $m_flyBehavior;
    private IQuackBehavior $m_quackBehavior;
    private IDanceBehavior $m_danceBehavior;

    public function __construct(
        IFlyBehavior $flyBehavior,
        IQuackBehavior $quackBehavior,
        IDanceBehavior $danceBehavior
    ) {
        $this->m_flyBehavior = $flyBehavior;
        $this->m_quackBehavior = $quackBehavior;
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Quack() : void
    {
        $this->m_quackBehavior->Quack();
    }

    public function Swim() : void
    {
        echo "I'm swimming\n";
    }

    public function Fly() : void
    {
        $this->m_flyBehavior->Fly();
    }

    public function Dance() : void
    {
        $this->m_danceBehavior->Dance();
    }

    public function SetFlyBehavior(IFlyBehavior $flyBehavior) : void
    {
        $this->m_flyBehavior = $flyBehavior;
    }

    public function SetDanceBehavior(IDanceBehavior $danceBehavior) : void
    {
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Display() : void {}

}
