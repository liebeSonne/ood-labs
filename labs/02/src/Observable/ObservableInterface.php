<?php

namespace App\Observable;

use App\Observer\ObserverInterface;

interface ObservableInterface
{
    public function registerObserver(ObserverInterface $observer) : void;
    public function notifyObservers() : void;
    public function removeObserver(ObserverInterface $observer) : void;
}