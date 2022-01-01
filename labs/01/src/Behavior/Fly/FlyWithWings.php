<?php

namespace App\Behavior\Fly;

class FlyWithWings implements IFlyBehavior
{
    protected int $counter = 0;

    public function Fly() : void
    {
        $this->counter++;
        echo "I'm flying № {$this->counter} with wings!!\n";
    }
}
