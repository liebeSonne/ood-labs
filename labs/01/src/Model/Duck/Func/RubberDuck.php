<?php

namespace App\Model\Duck\Func;

class RubberDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = 'flyNoWay';
        $quackBehavior = 'squeakBehavior';
        $danceBehavior = 'danceNoDance';
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm model duck\n";
    }
}