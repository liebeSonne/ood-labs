<?php

namespace App\Model\Display\Indicator;

interface IndicatorInterface
{
    public function setData(\StdClass $data) : void;
    public function display() : void;
}