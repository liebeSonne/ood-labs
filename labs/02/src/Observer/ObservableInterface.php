<?php

namespace App\Observer;

interface ObservableInterface
{
    public function registerObserver(ObserverInterface $observer, int $priority = 0) : void;
    public function notifyObservers() : void;
    public function removeObserver(ObserverInterface $observer) : void;
}