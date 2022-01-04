<?php

namespace App\Model\Display\Slot;

interface SlotDuoWeatherInterface
{
    public function slotInTemp($data) : void;
    public function slotInHumidity($data)  : void;
    public function slotInPressure($data)  : void;

    public function slotOutTemp($data)  : void;
    public function slotOutHumidity($data)  : void;
    public function slotOutPressure($data)  : void;
    public function slotOutWindSpeed($data)  : void;
    public function slotOutWindDirection($data)  : void;
}