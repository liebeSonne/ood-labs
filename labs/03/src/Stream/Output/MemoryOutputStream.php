<?php

namespace App\Stream\Output;

class MemoryOutputStream implements OutputDataStreamInterface
{
    private \SplFileObject $stream;

    public function __construct()
    {
        $filename = 'php://memory';
        $this->stream = new \SplFileObject($filename, 'ab');
    }

    public function writeByte(string $data) : void
    {
        $this->stream->fwrite($data);
    }

    public function writeBlock(\SplFileObject $srcData, int $size) : void
    {
        $str = $srcData->fread($size);
        $this->stream->fwrite($str);
    }
}