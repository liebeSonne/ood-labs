<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceBehaviorInterface;
use App\Behavior\Fly\FlyBehaviorInterface;
use App\Behavior\Quack\QuackBehaviorInterface;

class Duck
{
    private FlyBehaviorInterface $flyBehavior;
    private QuackBehaviorInterface $quackBehavior;
    private DanceBehaviorInterface $danceBehavior;

    public function __construct(
        FlyBehaviorInterface $flyBehavior,
        QuackBehaviorInterface $quackBehavior,
        DanceBehaviorInterface $danceBehavior
    ) {
        $this->setFlyBehavior($flyBehavior);
        $this->setQuackBehavior($quackBehavior);
        $this->setDanceBehavior($danceBehavior);
    }

    public function quack() : void
    {
        $this->quackBehavior->quack();
    }

    public function swim() : void
    {
        echo "I'm swimming\n";
    }

    public function fly() : void
    {
        $this->flyBehavior->fly();
    }

    public function dance() : void
    {
        $this->danceBehavior->dance();
    }

    public function setFlyBehavior(FlyBehaviorInterface $flyBehavior) : void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setQuackBehavior(QuackBehaviorInterface $quackBehavior) : void
    {
        $this->quackBehavior = $quackBehavior;
    }

    public function setDanceBehavior(DanceBehaviorInterface $danceBehavior) : void
    {
        $this->danceBehavior = $danceBehavior;
    }

    public function display() : void {}
}
