<?php

namespace App\Model\Display\Stats;

interface AvgStatsInterface
{
    public function getName(): string;
    public function getMin(): float;
    public function getMax(): float;
    public function getAvg(): float;
    public function update(float $value): void;
}