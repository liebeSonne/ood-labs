<?php

namespace App\Observer;

interface ObserverInterface
{
    public function update(\StdClass $data, Observable $subject) : void;
}
