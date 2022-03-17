<?php

namespace App\Model\Image;

interface ImageInterface
{
    public function getPath(): string;

    public function getWidth(): int;

    public function getHeight(): int;

    public function resize(int $width, int $height): void;

    public function setMarkDel(bool $mark): void;

    public function getMarkDel(): bool;
}