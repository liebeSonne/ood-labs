<?php

namespace App\Behavior\Quack;

class SqueakBehavior implements QuackBehaviorInterface
{
    public function quack() : void
    {
        echo "Squeek!!!\n";
    }
}
