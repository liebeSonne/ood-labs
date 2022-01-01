<?php

namespace App\Model\Duck\Func;

class MallardDuck extends Duck
{
    public static function create(): self
    {
        return new self(
            $flyBehavior = 'FlyWithWings',
            $quackBehavior = 'QuackBehavior',
            $danceBehavior = 'DanceWaltz'
        );
    }

    public function Display() : void
    {
        echo "I'm mallard duck\n";
    }
}