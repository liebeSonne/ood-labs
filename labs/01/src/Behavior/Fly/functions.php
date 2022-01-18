<?php

function createFlyWithWings() : callable
{
    return static function () : void
    {
        static $counter = 0;
        $counter++;
        echo "I'm flying № {$counter} with wings!!\n";
    };
}

function flyNoWay () : void {}