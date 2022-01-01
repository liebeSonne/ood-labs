<?php

namespace App\Observable;

use App\Observer\IObserver;

abstract class CObservable implements IObservable
{
    protected \SplObjectStorage $m_observers;

    public function __construct()
    {
        $this->m_observers = new \SplObjectStorage();
    }

    public function RegisterObserver(IObserver $observer) : void
    {
        $this->m_observers->attach($observer);
    }

    public function NotifyObservers() :void
    {
        $data = $this->GetChangedData();

        foreach ($this->m_observers as $observer) {
            $observer->Update($data);
        }
    }

    public function RemoveObserver(IObserver $observer) : void
    {
        $this->m_observers->detach($observer);
    }

    abstract protected function GetChangedData() : \StdClass;
}