<?php

namespace App;

class Color
{
    const GREEN = 'green';
    const RED = 'red';
    const BLUE = 'blue';
    const YELLOW = 'yellow';
    const PINK = 'pink';
    const BLACK = 'black';

    public static $COLOR_TO_HEX = [
        self::GREEN => '#00FF00',
        self::RED => '#FF0000',
        self::BLUE => '#0000FF',
        self::YELLOW => '#FFFF00',
        self::PINK => '#FF69B4',
        self::BLACK => '#000000',
    ];

    public static function colorToHex(string $color) : string
    {
        return self::$COLOR_TO_HEX[$color] ?? $color;
    }

    public static function hex2rgb($hexStr)
    {
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
        $rgbArray = [];

        if (strlen($hexStr) == 6) {
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3) {
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false;
        }

        return $rgbArray;
    }
}