<?php

namespace App\Model\Duck\Func;

class DecoyDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = 'flyNoWay';
        $quackBehavior = 'muteQuackBehavior';
        $danceBehavior = 'danceNoDance';
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm decoy duck\n";
    }
}