<?php

namespace App\Model\Display;

use App\Model\Display\Info\Formatter\DefaultInfoProFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Observer\Observable;
use App\Observer\ObserverInterface;

class DisplayPro implements ObserverInterface
{
    private InfoFormatterInterface $formatter;

    public function __construct()
    {
        $formatter = new DefaultInfoProFormatter();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
    }

    public function update(\StdClass $data, Observable $subject) : void
    {
        $this->formatter->display($data);
        echo "----------------\n";
    }
}