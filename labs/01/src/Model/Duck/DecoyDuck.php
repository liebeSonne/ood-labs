<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceNoDance;
use App\Behavior\Fly\FlyNoWay;
use App\Behavior\Quack\MuteQuackBehavior;

class DecoyDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = new FlyNoWay(),
            $quackBehavior = new MuteQuackBehavior(),
            $danceBehavior = new DanceNoDance()
        );
    }

    public function display() : void
    {
        echo "I'm decoy duck\n";
    }
}

