<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceNoDance;
use App\Behavior\Fly\FlyNoWay;
use App\Behavior\Quack\QuackBehavior;

class ModelDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = new FlyNoWay();
        $quackBehavior = new QuackBehavior();
        $danceBehavior = new DanceNoDance();
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm model duck\n";
    }
}
