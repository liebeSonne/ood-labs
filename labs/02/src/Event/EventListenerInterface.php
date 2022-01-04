<?php

namespace App\Event;

interface EventListenerInterface
{
    public function update(string $event, $data) : void;
}
