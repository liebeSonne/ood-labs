<?php

namespace App\Model\Duck\Func;

class MallardDuck extends Duck
{
    public static function create(): self
    {
        return new self(
            $flyBehavior = createFlyWithWings(),
            $quackBehavior = 'quackBehavior',
            $danceBehavior = 'danceWaltz'
        );
    }

    public function display() : void
    {
        echo "I'm mallard duck\n";
    }
}