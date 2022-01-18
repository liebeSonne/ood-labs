<?php

namespace App\Behavior\Dance;

class DanceMinuet implements DanceBehaviorInterface
{
    public function dance() : void
    {
        echo "I'm dancing a Minuet!!\n";
    }
}
