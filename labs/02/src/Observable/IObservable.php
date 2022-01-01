<?php

namespace App\Observable;

use App\Observer\IObserver;

interface IObservable
{
    public function RegisterObserver(IObserver $observer) : void;
    public function NotifyObservers() : void;
    public function RemoveObserver(IObserver $observer) : void;
}