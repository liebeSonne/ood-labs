<?php

namespace App\Model\Duck\Func;

class RubberDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'flyNoWay',
            $quackBehavior = 'quackBehavior',
            $danceBehavior = 'danceNoDance'
        );
    }

    public function display() : void
    {
        echo "I'm model duck\n";
    }
}