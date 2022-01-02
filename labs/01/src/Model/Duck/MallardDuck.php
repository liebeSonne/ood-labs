<?php

namespace App\Model\Duck;

use App\Behavior\Dance\DanceWaltz;
use App\Behavior\Fly\FlyWithWings;
use App\Behavior\Quack\QuackBehavior;

class MallardDuck extends Duck
{
    public static function create(): self
    {
        return new self(
            $flyBehavior = new FlyWithWings(),
            $quackBehavior = new QuackBehavior(),
            $danceBehavior = new DanceWaltz()
        );
    }

    public function display() : void
    {
        echo "I'm mallard duck\n";
    }
}
