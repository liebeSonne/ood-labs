<?php

namespace App\Model\Image;

class Image implements ImageInterface
{
    private string $path;
    private int $width;
    private int $height;

    public function __construct($path, $width, $height)
    {
        $this->path = $path;
        $this->resize($width, $height);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function resize(int $width, int $height): void
    {
        $this->width = $width;
        $this->height = $height;
    }
}