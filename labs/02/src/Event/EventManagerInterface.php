<?php

namespace App\Event;

interface EventManagerInterface
{
    /**
     * @param EventListenerInterface $listener
     * @param string[] $event
     * @return void
     */
    public function addEventListener(EventListenerInterface $listener, array $events) : void;

    /**
     * @param EventListenerInterface $listener
     * @param string[] $event
     * @return void
     */
    public function removeEventListener(EventListenerInterface $listener, array $events) : void;

    public function notifyEventListener(string $event, $data) : void;
}
