<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceNoDance;
use App\Behavior\Fly\FlyNoWay;
use App\Behavior\Quack\QuackBehavior;

class RubberDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = new FlyNoWay(),
            $quackBehavior = new QuackBehavior(),
            $danceBehavior = new DanceNoDance()
        );
    }

    public function display() : void
    {
        echo "I'm model duck\n";
    }
}

