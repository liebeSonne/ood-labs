<?php

namespace App\Model\Format;

class PressureFormat
{
    public const K_PASCAL = 'кПа';
    public const MM_RT_ST = 'мм.рт.ст.';

    /**
     * From мм.рт.ст. to кПа
     * @param float $value
     * @return float
     */
    public static function toKPascal(float $value): float
    {
        return $value * 101325 / 760 / 1000;
    }

    /**
     * From кПа to мм.рт.ст.
     * @param float $value
     * @return float
     */
    public static function toMmRtSt(float $value): float
    {
        return $value / 101325 * 760 * 1000;
    }
}