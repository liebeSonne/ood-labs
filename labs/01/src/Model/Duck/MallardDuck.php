<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceWaltz;
use App\Behavior\Fly\FlyWithWings;
use App\Behavior\Quack\QuackBehavior;

class MallardDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = new FlyWithWings();
        $quackBehavior = new QuackBehavior();
        $danceBehavior = new DanceWaltz();
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm mallard duck\n";
    }
}
