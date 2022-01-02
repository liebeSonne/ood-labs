<?php

namespace App\Behavior\Dance;

class DanceWaltz implements DanceBehaviorInterface
{
    public function dance() : void
    {
        echo "I'm dance Waltz!!\n";
    }
}
