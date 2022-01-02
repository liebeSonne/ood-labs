<?php

function DanceWaltz() : void
{
    echo "I'm dance Waltz!!\n";
}

function DanceMinuet() : void
{
    echo "I'm dance Minuet!!\n";
}

function DanceNoDance () : void {}

function createFlyWithWings() : callable
{
    return static function () : void
    {
        static $counter = 0;
        $counter++;
        echo "I'm flying № {$counter} with wings!!\n";
    };
}

function FlyNoWay () : void {}

function QuackBehavior() : void
{
    echo "Quack Quack!!!\n";
}

function SqueakBehavior() : void
{
    echo "Squeek!!!\n";
}

function MuteQuackBehavior() : void {}

