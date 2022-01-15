<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceNoDance;
use App\Behavior\Fly\FlyNoWay;
use App\Behavior\Quack\MuteQuackBehavior;

class DecoyDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = new FlyNoWay();
        $quackBehavior = new MuteQuackBehavior();
        $danceBehavior = new DanceNoDance();
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm decoy duck\n";
    }
}

