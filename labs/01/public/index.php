<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Duck\Duck;
use App\Model\Duck\MallardDuck;
use App\Model\Duck\RedheadDuck;
use App\Model\Duck\RubberDuck;
use App\Model\Duck\DecoyDuck;
use App\Model\Duck\ModelDuck;
use App\Behavior\Fly\FlyWithWings;

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
    $mallardDuck = MallardDuck::create();
    playWithDuck($mallardDuck);

    $redheadDuck = RedheadDuck::create();
    playWithDuck($redheadDuck);

    $rubberDuck = RubberDuck::create();
    playWithDuck($rubberDuck);

    $decoyDuck = DecoyDuck::create();
    playWithDuck($decoyDuck);

    $modelDuck = ModelDuck::create();
    playWithDuck($modelDuck);

    $modelDuck->setFlyBehavior(new FlyWithWings());
    playWithDuck($modelDuck);
    playWithDuck($modelDuck);
}

main();

