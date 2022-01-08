<?php

namespace App\Canvas;

use App\Color;
use App\Point;

class PngCanvas implements CanvasInterface
{
    private $image;
    private $color;

    public function __construct(int $width, int $height)
    {
        $this->image = imagecreate($width, $height);

        $white = imagecolorallocate($this->image,255,255,255);
        imagefill($this->image,0,0,$white);

        $this->color = imagecolorallocate($this->image, 0,0,0);
    }

    public function show() : void
    {
        header("Content-Type: image/png");
        imagepng($this->image);
    }

    public function saveTo(string $file) : void
    {
        imagepng($this->image, $file);
    }

    public function setColor(string $color) : void
    {
        $hex = Color::colorToHex($color);
        $rgb = Color::hex2rgb($hex);

        $this->color = imagecolorallocate($this->image, $rgb['red'], $rgb['green'], $rgb['blue']);
    }

    public function drawLine(Point $from, Point $to) : void
    {
        imageline($this->image, $from->getX(), $from->getY(), $to->getX(), $to->getY(), $this->color);
    }

    public function drawEllipse(Point $center, float $width, float $height) : void
    {
        imageellipse($this->image, $center->getX(), $center->getY(), $width, $height, $this->color);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }
}