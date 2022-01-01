<?php

namespace App\Behavior\Quack;

class SqueakBehavior implements IQuackBehavior
{
    public function Quack() : void
    {
        echo "Squeek!!!\n";
    }
}
