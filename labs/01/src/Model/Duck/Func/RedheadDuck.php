<?php

namespace App\Model\Duck\Func;

class RedheadDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = createFlyWithWings();
        $quackBehavior = 'quackBehavior';
        $danceBehavior = 'danceMinuet';
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm decoy duck\n";
    }
}