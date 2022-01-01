<?php

namespace App\Observer;

interface IObserver
{
    public function Update(\StdClass $data) : void;
}
