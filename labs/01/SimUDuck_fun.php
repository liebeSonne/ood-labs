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

function FlyWithWings(int $counter = 0) : void
{
    echo "I'm flying № {$counter} with wings!!\n";
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

class Duck
{
    private $m_flyBehavior;
    private $m_quackBehavior;
    private $m_danceBehavior;
    private int $fly_counter = 0;

    public function __construct(
        callable $flyBehavior,
        callable $quackBehavior,
        callable $danceBehavior
    ) {
        $this->m_flyBehavior = $flyBehavior;
        $this->m_quackBehavior = $quackBehavior;
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Quack() : void
    {
        call_user_func($this->m_quackBehavior);
    }

    public function Swim() : void
    {
        echo "I'm swimming\n";
    }

    public function Fly() : void
    {
        $this->fly_counter++;
        call_user_func($this->m_flyBehavior, $this->fly_counter);
    }

    public function Dance() : void
    {
        call_user_func($this->m_danceBehavior);
    }

    public function SetFlyBehavior($flyBehavior) : void
    {
        $this->fly_counter = 0;
        $this->m_flyBehavior = $flyBehavior;
    }

    public function SetDanceBehavior($danceBehavior) : void
    {
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Display() : void {}

}

class MallardDuck extends Duck
{
    public static function create(): self
    {
        global $QuackBehavior;
        return new self(
            $flyBehavior = 'FlyWithWings',
            $quackBehavior = 'QuackBehavior',
            $danceBehavior = 'DanceWaltz'
        );
    }

    public function Display() : void
    {
        echo "I'm mallard duck\n";
    }
}

class RedheadDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'FlyNoWay',
            $quackBehavior = 'MuteQuackBehavior',
            $danceBehavior = 'DanceNoDance'
        );
    }

    public function Display() : void
    {
        echo "I'm decoy duck\n";
    }
}


class DecoyDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'FlyNoWay',
            $quackBehavior = 'MuteQuackBehavior',
            $danceBehavior = 'DanceNoDance'
        );
    }

    public function Display() : void
    {
        echo "I'm decoy duck\n";
    }
}

class RubberDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'FlyNoWay',
            $quackBehavior = 'QuackBehavior',
            $danceBehavior = 'DanceNoDance'
        );
    }

    public function Display() : void
    {
        echo "I'm model duck\n";
    }
}

class ModelDuck extends Duck
{
    public static function create() : self
    {
        return new self(
            $flyBehavior = 'FlyNoWay',
            $quackBehavior = 'QuackBehavior',
            $danceBehavior = 'DanceNoDance'
        );
    }

    public function Display() : void
    {
        echo "I'm model duck\n";
    }
}

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
