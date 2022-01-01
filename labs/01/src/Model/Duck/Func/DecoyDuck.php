<?php

namespace App\Model\Duck\Func;

class DecoyDuck extends Duck
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