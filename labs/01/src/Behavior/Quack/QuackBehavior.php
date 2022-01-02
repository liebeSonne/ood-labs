<?php

namespace App\Behavior\Quack;

class QuackBehavior implements QuackBehaviorInterface
{
    public function quack() : void
    {
        echo "Quack Quack!!!\n";
    }
}
