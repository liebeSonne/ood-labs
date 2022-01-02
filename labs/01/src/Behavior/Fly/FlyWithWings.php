<?php

namespace App\Behavior\Fly;

class FlyWithWings implements FlyBehaviorInterface
{
    protected int $counter = 0;

    public function fly() : void
    {
        $this->counter++;
        echo "I'm flying № {$this->counter} with wings!!\n";
    }
}
