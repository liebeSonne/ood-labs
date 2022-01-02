<?php

namespace App\Model\Duck\Func;

class RedheadDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'flyNoWay',
            $quackBehavior = 'muteQuackBehavior',
            $danceBehavior = 'danceNoDance'
        );
    }

    public function display() : void
    {
        echo "I'm decoy duck\n";
    }
}