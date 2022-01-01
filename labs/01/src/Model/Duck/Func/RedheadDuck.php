<?php

namespace App\Model\Duck\Func;

class RedheadDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'FlyNoWay',
            $quackBehavior = 'MuteQuackBehavior',
            $danceBehavior = 'DanceNoDance'
        );
    }

    public function Display() : void
    {
        echo "I'm decoy duck\n";
    }
}