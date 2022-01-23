<?php

namespace App\Model\Display\Indicator;

use App\Model\Display\Info\Formatter\InfoFormatterInterface;

class CurrentIndicator implements IndicatorInterface
{
    private \StdClass $data;

    private string $name;

    private InfoFormatterInterface $formatter;

    public function __construct(string $name, InfoFormatterInterface $formatter)
    {
        $this->name = $name;
        $this->data = new \StdClass();
        $this->setFormatter($formatter);
    }

    public function setFormatter(InfoFormatterInterface $formatter) : void
    {
        $this->formatter = $formatter;
    }

    public function setData(\StdClass $data) : void
    {
        $this->data = $data;
    }

    public function display() : void
    {
        echo "-[" . $this->name . "]: \n";
        $this->formatter->display($this->data);
    }
}