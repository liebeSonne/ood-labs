<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceMinuet;
use App\Behavior\Fly\FlyWithWings;
use App\Behavior\Quack\QuackBehavior;

class RedheadDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = new FlyWithWings();
        $quackBehavior = new QuackBehavior();
        $danceBehavior = new DanceMinuet();
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm decoy duck\n";
    }
}
