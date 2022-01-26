<?php

namespace App\Stream\Input\Decorate;

class DecompressInputStream extends InputStreamDecoration
{
    private int $counter = 0;
    private $byte = null;

    public function isEOF(): bool
    {
        return parent::isEOF() && $this->counter === 0;
    }

    public function readByte(): string
    {
        if ($this->counter > 0) {
            $this->counter--;
            return $this->byte;
        } elseif ($this->counter === 0) {
            $this->readByteAndCounter();
            $this->counter--;
            return $this->byte;
        }
        return '';
    }

    public function readBlock(\SplFileObject $dstBuffer, int $size): int
    {
        $count = 0;
        for ($i = 0; $i < $size; $i++)
        {
            $byte = $this->readByte();
            $dstBuffer->fwrite($byte);
            $count++;
        }
        return $count;
    }

    private function readByteAndCounter()
    {
        $this->byte = parent::readByte();
        $this->counter = (int) parent::readByte();
    }
}