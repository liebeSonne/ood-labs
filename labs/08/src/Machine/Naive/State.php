<?php

namespace App\Machine\Naive;

class State
{
    const SOLD_OUT = 'sold_out'; // Жвачка закончилась
    const NO_QUARTER = 'no_quarter'; // Нет монетки
    const HAS_QUARTER = 'has_quarter'; // Есть монетка
    const SOLD = 'sold'; // Монетка выдана
}