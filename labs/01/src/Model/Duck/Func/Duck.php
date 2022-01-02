<?php

namespace App\Model\Duck\Func;

class Duck
{
    private $m_flyBehavior;
    private $m_quackBehavior;
    private $m_danceBehavior;

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
        if (is_callable($this->m_quackBehavior)) {
            call_user_func($this->m_quackBehavior);
        }
    }

    public function Swim() : void
    {
        echo "I'm swimming\n";
    }

    public function Fly() : void
    {
        if (is_callable($this->m_flyBehavior)) {
            call_user_func($this->m_flyBehavior);
        }
    }

    public function Dance() : void
    {
        if (is_callable($this->m_danceBehavior)) {
            call_user_func($this->m_danceBehavior);
        }
    }

    public function SetFlyBehavior($flyBehavior) : void
    {
        $this->m_flyBehavior = $flyBehavior;
    }

    public function SetDanceBehavior($danceBehavior) : void
    {
        $this->m_danceBehavior = $danceBehavior;
    }

    public function Display() : void {}

}