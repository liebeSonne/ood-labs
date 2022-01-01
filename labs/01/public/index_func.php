<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../lib/behavior.functions.php';

use App\Model\Duck\Func\Duck;
use App\Model\Duck\Func\MallardDuck;
use App\Model\Duck\Func\RedheadDuck;
use App\Model\Duck\Func\RubberDuck;
use App\Model\Duck\Func\DecoyDuck;
use App\Model\Duck\Func\ModelDuck;

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

    $modelDuck->SetFlyBehavior('FlyWithWings');
    PlayWithDuck($modelDuck);
    PlayWithDuck($modelDuck);

    $modelDuck->SetFlyBehavior('FlyWithWings');
    PlayWithDuck($modelDuck);
    PlayWithDuck($modelDuck);
}

main();

