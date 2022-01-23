<?php

namespace App\Model\Display\Info\Formatter;

interface InfoFormatterInterface
{
    public function display(\StdClass $data): void;
}