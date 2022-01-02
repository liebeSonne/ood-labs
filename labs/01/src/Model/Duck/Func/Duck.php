<?php

namespace App\Model\Duck\Func;

class Duck
{
    /**
     * @var callable
     */
    private $flyBehavior;

    /**
     * @var callable
     */
    private $quackBehavior;

    /**
     * @var callable
     */
    private $danceBehavior;

    public function __construct(
        callable $flyBehavior,
        callable $quackBehavior,
        callable $danceBehavior
    ) {
        $this->setFlyBehavior($flyBehavior);
        $this->setQuackBehavior($quackBehavior);
        $this->setDanceBehavior($danceBehavior);
    }

    public function quack() : void
    {
        if (is_callable($this->quackBehavior)) {
            call_user_func($this->quackBehavior);
        }
    }

    public function swim() : void
    {
        echo "I'm swimming\n";
    }

    public function fly() : void
    {
        if (is_callable($this->flyBehavior)) {
            call_user_func($this->flyBehavior);
        }
    }

    public function dance() : void
    {
        if (is_callable($this->danceBehavior)) {
            call_user_func($this->danceBehavior);
        }
    }

    public function setFlyBehavior($flyBehavior) : void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setQuackBehavior($quackBehavior) : void
    {
        $this->quackBehavior = $quackBehavior;
    }

    public function setDanceBehavior($danceBehavior) : void
    {
        $this->danceBehavior = $danceBehavior;
    }

    public function display() : void {}
}