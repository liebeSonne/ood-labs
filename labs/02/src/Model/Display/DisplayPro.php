<?php

namespace App\Model\Display;

use App\Model\Display\Info\Formatter\DefaultInfoProFormatter;
use App\Model\Display\Info\Formatter\InfoProFormatterInterface;
use App\Model\Weather\WeatherInfoPro;
use App\Observer\ObservableInterface;
use App\Observer\ObserverInterface;

class DisplayPro implements ObserverInterface
{
    private InfoProFormatterInterface $formatter;

    public function __construct()
    {
        $formatter = new DefaultInfoProFormatter();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoProFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
    }

    public function update(\StdClass $data, ObservableInterface $subject) : void
    {
        $info = WeatherInfoPro::createInfo($data);
        $this->formatter->display($info);
        echo "----------------\n";
    }
}