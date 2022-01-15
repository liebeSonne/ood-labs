<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../lib/behavior.functions.php';

use App\Model\Duck\Func\Duck;
use App\Model\Duck\Func\MallardDuck;
use App\Model\Duck\Func\RedheadDuck;
use App\Model\Duck\Func\RubberDuck;
use App\Model\Duck\Func\DecoyDuck;
use App\Model\Duck\Func\ModelDuck;

function drawDuck(Duck $duck) : void
{
    $duck->display();
}

function playWithDuck(Duck $duck) : void
{
    drawDuck($duck);
    $duck->quack();
    $duck->fly();
    $duck->dance();
    echo "\n";
}

function main() : void
{
    $mallardDuck = new MallardDuck();
    playWithDuck($mallardDuck);

    $redheadDuck = new RedheadDuck();
    playWithDuck($redheadDuck);

    $rubberDuck = new RubberDuck();
    playWithDuck($rubberDuck);

    $decoyDuck = new DecoyDuck();
    playWithDuck($decoyDuck);

    $modelDuck = new ModelDuck();
    playWithDuck($modelDuck);

    $modelDuck->setFlyBehavior(createFlyWithWings());
    playWithDuck($modelDuck);
    playWithDuck($modelDuck);

    $modelDuck->setFlyBehavior('flyNoWay');
    playWithDuck($modelDuck);
    playWithDuck($modelDuck);

    $modelDuck->setFlyBehavior(createFlyWithWings());
    playWithDuck($modelDuck);
    playWithDuck($modelDuck);
}

main();

