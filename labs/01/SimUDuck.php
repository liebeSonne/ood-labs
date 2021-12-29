<?php

interface IDanceBehavior
{
    public function Dance() : void;
}

class DanceWaltz implements IDanceBehavior
{
    public function Dance() : void
    {
        echo "I'm dance Waltz!!\n";
    }
}

class DanceMinuet implements IDanceBehavior
{
    public function Dance() : void
    {
        echo "I'm dance Minuet!!\n";
    }
}

class DanceNoDance implements IDanceBehavior
{
    public function Dance() : void {}
}

interface IFlyBehavior
{
    public function Fly() : void;
}

class FlyWithWings implements IFlyBehavior
{
    protected int $counter = 0;
    public function Fly() : void
    {
        $this->counter++;
        echo "I'm flying № {$this->counter} with wings!!\n";
    }
}

class FlyNoWay implements IFlyBehavior
{
    public function Fly() : void {}
}

interface IQuackBehavior
{
    public function Quack() : void;
}

class QuackBehavior implements IQuackBehavior
{
    public function Quack() : void
    {
        echo "Quack Quack!!!\n";
    }
}

class SqueakBehavior implements IQuackBehavior
{
    public function Quack() : void
    {
        echo "Squeek!!!\n";
    }
}

class MuteQuackBehavior implements IQuackBehavior
{
    public function Quack() : void {}
}

class Duck
{
    private IFlyBehavior $m_flyBehavior;
    private IQuackBehavior $m_quackBehavior;
    private IDanceBehavior $m_danceBehavior;

    public function __construct(
        IFlyBehavior $flyBehavior,
        IQuackBehavior $quackBehavior,
        IDanceBehavior $danceBehavior
    ) {
        $this->m_flyBehavior = $flyBehavior;
        $this->m_quackBehavior = $quackBehavior;
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Quack() : void
    {
        $this->m_quackBehavior->Quack();
    }

    public function Swim() : void
    {
        echo "I'm swimming\n";
    }

    public function Fly() : void
    {
        $this->m_flyBehavior->Fly();
    }

    public function Dance() : void
    {
        $this->m_danceBehavior->Dance();
    }

    public function SetFlyBehavior(IFlyBehavior $flyBehavior) : void
    {
        $this->m_flyBehavior = $flyBehavior;
    }

    public function SetDanceBehavior(IDanceBehavior $danceBehavior) : void
    {
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Display() : void {}

}

class MallardDuck extends Duck
{
    public static function create(): self
    {
        return new self(
            $flyBehavior = new FlyWithWings(),
            $quackBehavior = new QuackBehavior(),
            $danceBehavior = new DanceWaltz()
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
            $flyBehavior = new FlyNoWay(),
            $quackBehavior = new MuteQuackBehavior(),
            $danceBehavior = new DanceNoDance()
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
            $flyBehavior = new FlyNoWay(),
            $quackBehavior = new MuteQuackBehavior(),
            $danceBehavior = new DanceNoDance()
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
             $flyBehavior = new FlyNoWay(),
             $quackBehavior = new QuackBehavior(),
             $danceBehavior = new DanceNoDance()
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
            $flyBehavior = new FlyNoWay(),
            $quackBehavior = new QuackBehavior(),
            $danceBehavior = new DanceNoDance()
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

    $modelDuck->SetFlyBehavior(new FlyWithWings());
    PlayWithDuck($modelDuck);
    PlayWithDuck($modelDuck);
}

main();
