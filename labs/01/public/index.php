<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Duck\Duck;
use App\Model\Duck\MallardDuck;
use App\Model\Duck\RedheadDuck;
use App\Model\Duck\RubberDuck;
use App\Model\Duck\DecoyDuck;
use App\Model\Duck\ModelDuck;
use App\Behavior\Fly\FlyWithWings;

function DrawDuck(Duck $duck) : void
{
    $duck->Display();
}

function PlayWithDuck(Duck $duck) : void
{
    DrawDuck($duck);
    $duck->Quack();
    $duck->Fly();
    $duck->Dance();
    echo "\n";
}

function main() : void
{
    $mallardDuck = MallardDuck::create();
    PlayWithDuck($mallardDuck);

    $redheadDuck = RedheadDuck::create();
    PlayWithDuck($redheadDuck);

    $rubberDuck = RubberDuck::create();
    PlayWithDuck($rubberDuck);

    $decoyDuck = DecoyDuck::create();
    PlayWithDuck($decoyDuck);

    $modelDuck = ModelDuck::create();
    PlayWithDuck($modelDuck);

    $modelDuck->SetFlyBehavior(new FlyWithWings());
    PlayWithDuck($modelDuck);
    PlayWithDuck($modelDuck);
}

main();

