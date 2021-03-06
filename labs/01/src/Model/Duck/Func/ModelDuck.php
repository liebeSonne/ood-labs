<?php

namespace App\Model\Duck\Func;

class ModelDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = 'flyNoWay';
        $quackBehavior = 'quackBehavior';
        $danceBehavior = 'danceNoDance';
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm model duck\n";
    }
}