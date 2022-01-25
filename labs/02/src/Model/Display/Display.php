<?php

namespace App\Model\Display;

use App\Model\Display\Info\Formatter\DefaultInfoFormatter;
use App\Model\Display\Info\Formatter\InfoFormatterInterface;
use App\Model\Weather\WeatherInfo;
use App\Observer\ObservableInterface;
use App\Observer\ObserverInterface;

class Display implements ObserverInterface
{
    private InfoFormatterInterface $formatter;

    public function __construct()
    {
        $formatter = new DefaultInfoFormatter();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
    }

    public function update(\StdClass $data, ObservableInterface $subject) : void
    {
        $info = WeatherInfo::createInfo($data);
        $this->formatter->display($info);
        echo "----------------\n";
    }
}