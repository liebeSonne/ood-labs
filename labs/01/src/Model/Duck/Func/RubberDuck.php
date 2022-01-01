<?php

namespace App\Model\Duck\Func;

class RubberDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'FlyNoWay',
            $quackBehavior = 'QuackBehavior',
            $danceBehavior = 'DanceNoDance'
        );
    }

    public function Display() : void
    {
        echo "I'm model duck\n";
    }
}