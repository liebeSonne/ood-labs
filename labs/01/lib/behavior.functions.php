<?php

function danceWaltz() : void
{
    echo "I'm dance Waltz!!\n";
}

function danceMinuet() : void
{
    echo "I'm dance Minuet!!\n";
}

function danceNoDance () : void {}

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

function quackBehavior() : void
{
    echo "Quack Quack!!!\n";
}

function squeakBehavior() : void
{
    echo "Squeek!!!\n";
}

function muteQuackBehavior() : void {}

