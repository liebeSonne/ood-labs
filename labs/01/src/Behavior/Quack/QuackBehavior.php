<?php

namespace App\Behavior\Quack;

class QuackBehavior implements IQuackBehavior
{
    public function Quack() : void
    {
        echo "Quack Quack!!!\n";
    }
}
