<?php

namespace App\Observer;

abstract class Observable implements ObservableInterface
{
    private array $observers = [];

    final public function registerObserver(ObserverInterface $observer, int $priority = 0) : void
    {
        $item = new \StdClass;
        $item->observer = $observer;
        $item->priority = $priority;

        $this->observers[] = $item;
        $this->sortObservers();
    }

    private function sortObservers() : void
    {
        usort($this->observers, static function ($a, $b) {
            if ($a->priority < $b->priority)
            {
                return 1;
            }
            if ($a->priority > $b->priority)
            {
                return -1;
            }
            return 0;
        });
    }

    final public function notifyObservers() :void
    {
        $data = $this->getChangedData();

        foreach ($this->observers as $item) {
            $item->observer->update($data);
        }
    }

    final public function removeObserver(ObserverInterface $observer) : void
    {
        $key = false;
        foreach ($this->observers as $k => $item) {
            if ($item->observer === $observer) {
                $key = $k;
                break;
            }
        }

        if ($key !== false)
        {
            unset($this->observers[$key]);
        }
    }

    abstract protected function getChangedData() : \StdClass;
}