<?php

namespace App\Model\Display\Stats;

class AvgStats implements AvgStatsInterface
{
    private float $min = PHP_FLOAT_MAX;
    private float $max = PHP_FLOAT_MIN;
    private float $acc = 0;
    private int $count = 0;

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function update(float $value): void
    {
        $this->min = min($this->min, $value);
        $this->max = max($this->max, $value);
        $this->acc += $value;
        ++$this->count;
    }

    public function getAvg(): float
    {
        return $this->count === 0 ? 0 : ($this->acc / $this->count);
    }

    public function getMin(): float
    {
        return $this->min;
    }

    public function getMax(): float
    {
        return $this->max;
    }
}
