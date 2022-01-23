<?php

namespace App\Model\Display\Stats;

class AvgWindDirectionStats implements AvgStatsInterface
{
    private float $min = PHP_FLOAT_MAX;
    private float $max = PHP_FLOAT_MIN;
    private int $count = 0;
    private float $sumSin = 0;
    private float $sumCos = 0;

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
        ++$this->count;

        $rad = deg2rad((float) $value);
        $this->sumSin += sin($rad);
        $this->sumCos += cos($rad);
    }

    public function getAvg(): float
    {
        return (rad2deg(atan2($this->sumSin, $this->sumCos)) + 360) % 360;
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