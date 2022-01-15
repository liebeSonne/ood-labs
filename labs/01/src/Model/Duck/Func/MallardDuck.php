<?php

namespace App\Model\Duck\Func;

class MallardDuck extends Duck
{
    public function __construct()
    {
        $flyBehavior = createFlyWithWings();
        $quackBehavior = 'quackBehavior';
        $danceBehavior = 'danceWaltz';
        parent::__construct($flyBehavior, $quackBehavior, $danceBehavior);
    }

    public function display() : void
    {
        echo "I'm mallard duck\n";
    }
}