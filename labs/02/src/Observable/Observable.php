<?php

namespace App\Observable;

use App\Observer\ObserverInterface;

abstract class Observable implements ObservableInterface
{
    protected array $observers = [];

    public function registerObserver(ObserverInterface $observer) : void
    {
        $this->observers[] = $observer;
    }

    public function notifyObservers() :void
    {
        $data = $this->getChangedData();

        foreach ($this->observers as $observer) {
            $observer->update($data);
        }
    }

    public function removeObserver(ObserverInterface $observer) : void
    {
        $key = array_search($observer, $this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    abstract protected function getChangedData() : \StdClass;
}