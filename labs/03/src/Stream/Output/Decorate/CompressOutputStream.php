<?php

namespace App\Stream\Output\Decorate;

class CompressOutputStream extends OutputStreamDecoration
{
    private int $counter = 0;
    private $byte = null;

    public function writeByte(string $data) : void
    {
        if (is_null($this->byte)) {
            $this->setNextByte($data);
        } elseif ($data === $this->byte) {
            $this->counter++;
        } else {
            $this->writeChunk();
            $this->setNextByte($data);
        }
    }

    public function writeBlock(\SplFileObject $srcData, int $size) : void
    {
        for ($i = 0; $i < $size; $i++)
        {
            $buffer = $srcData->fread(1);
            self::writeByte($buffer);
        }
    }

    public function close(): void
    {
        if ($this->counter > 0) {
            $this->writeChunk();
        }
        parent::close();
    }

    private function setNextByte(string $byte)
    {
        $this->byte = $byte;
        $this->counter = 1;
    }

    private function writeChunk()
    {
        $counter = $this->counter;
        while ($counter > 0) {
            $curCount = min([$counter, 255]);
            parent::writeByte($this->byte);
            parent::writeByte($curCount);
            $counter -= $curCount;
        }
    }
}
