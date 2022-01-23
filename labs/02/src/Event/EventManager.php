<?php

namespace App\Event;

class EventManager implements EventManagerInterface
{
    private array $eventListeners = [];

    final public function addEventListener(EventListenerInterface $listener, array $events) : void
    {
        foreach ($events as $event) {
            $this->eventListeners[$event][] = $listener;
        }
    }

    final public function removeEventListener(EventListenerInterface $listener, array $events) : void
    {
        foreach ($events as $event) {
            if (isset($this->eventListeners[$event])) {
                $key = array_search($listener, $this->eventListeners[$event]);
                if ($key !== false) {
                    unset($this->eventListeners[$event][$key]);
                }
            }
        }
    }

    final public function notifyEventListener(string $event, $data) : void
    {
        foreach (($this->eventListeners[$event] ?? []) as $listener)
        {
            $listener->update($event, $data);
        }
    }
}